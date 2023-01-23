<?php

/*
 * @method gregorian_to_jalali ($g_y, $g_m, $g_d,$str)       return gregorian to jalali converted date
 * @method jalali_to_gregorian($j_y, $j_m, $j_d,$str)        return jalali to gregorian converted date
 *
 * @author     Roozbeh Baabakaan
 * @version    SVN: $Id: gregorian_jalali 1 2012-12-20 19:07:0
 */

use App\Models\Admin;
use App\Models\Defense;
use App\Models\Department;
use App\Models\Field;
use App\Models\Professor;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

setlocale(LC_ALL, "fa_IR");

class SendSms_Req
{
    public $SmsBody;
    public $Mobiles;
    public $SmsNumber;
}

class ConnectToApi
{
    public $url;
    public $apikey;

    public function __construct($MainUrl, $apikey)
    {
        $this->url = $MainUrl;
        $this->apikey = $apikey;
    }

    public function Exec($urlpath, $req)
    {
        try {
            $this->url .= "/Apiv2/" . $urlpath;
            $ch = curl_init($this->url);
            $jsonDataEncoded = json_encode($req, JSON_THROW_ON_ERROR);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            $header = [
                "authorization: BASIC APIKEY:" . $this->apikey,
                "Content-Type: application/json;charset=utf-8",
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            $result = curl_exec($ch);
            $res = json_decode($result, false, 512, JSON_THROW_ON_ERROR);
            curl_close($ch);
            return $res;
        } catch (Exception $ex) {
            return "";
        }
    }
}

class Similarity
{
    public static function dot($tags)
    {
        $tags = array_unique($tags);
        $tags = array_fill_keys($tags, 0);
        ksort($tags);
        return $tags;
    }

    public static function cosine($a, $b, $base)
    {
        $a = array_fill_keys($a, 1) + $base;
        $b = array_fill_keys($b, 1) + $base;
        ksort($a);
        ksort($b);
        return (new Similarity())->dot_product($a, $b) /
            ((new Similarity())->magnitude($a) *
                (new Similarity())->magnitude($b));
    }

    protected function dot_product($a, $b)
    {
        $products = array_map(
            function ($a, $b) {
                return $a * $b;
            },
            $a,
            $b
        );
        return array_reduce($products, function ($a, $b) {
            return $a + $b;
        });
    }

    protected function magnitude($point)
    {
        $squares = array_map(function ($x) {
            return $x ** 2;
        }, $point);
        return sqrt(
            array_reduce($squares, function ($a, $b) {
                return $a + $b;
            })
        );
    }
}

/**
 * @param Subject $subject
 * @return string
 */
function getSubjectImagePath(Subject $subject)
{
    $img = $subject->image_name;
    if ($img === null) {
        $img = "default_subject.jpg";
    }
    return asset("storage/images/" . $img);
}

function div($a, $b)
{
    return (int)($a / $b);
}

function gregorian_to_jalali($g_y, $g_m, $g_d, $str)
{
    $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];

    $gy = $g_y - 1600;
    $gm = $g_m - 1;
    $gd = $g_d - 1;

    $g_day_no =
        365 * $gy + div($gy + 3, 4) - div($gy + 99, 100) + div($gy + 399, 400);

    for ($i = 0; $i < $gm; ++$i) {
        $g_day_no += $g_days_in_month[$i];
    }
    if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || $gy % 400 == 0)) {
        /* leap and after Feb */
        $g_day_no++;
    }
    $g_day_no += $gd;

    $j_day_no = $g_day_no - 79;

    $j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
    $j_day_no = $j_day_no % 12053;

    $jy = 979 + 33 * $j_np + 4 * div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */

    $j_day_no %= 1461;

    if ($j_day_no >= 366) {
        $jy += div($j_day_no - 1, 365);
        $j_day_no = ($j_day_no - 1) % 365;
    }

    for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i) {
        $j_day_no -= $j_days_in_month[$i];
    }
    $jm = $i + 1;
    $jd = $j_day_no + 1;
    if ($str) {
        return $jy . "/" . $jm . "/" . $jd;
    }
    return [$jy, $jm, $jd];
}

function jalali_to_gregorian($sdate, $str)
{
    $t = strtotime($sdate);
    $j_y = (int)date("Y", $t);
    $j_m = (int)date("m", $t);
    $j_d = (int)date("d", $t);

    $g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    $j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];

    $jy = (int)$j_y - 979;
    $jm = (int)$j_m - 1;
    $jd = (int)$j_d - 1;

    $j_day_no = 365 * $jy + div($jy, 33) * 8 + div(($jy % 33) + 3, 4);

    for ($i = 0; $i < $jm; ++$i) {
        $j_day_no += $j_days_in_month[$i];
    }

    $j_day_no += $jd;

    $g_day_no = $j_day_no + 79;

    $gy =
        1600 +
        400 *
        div(
            $g_day_no,
            146097
        ); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
    $g_day_no = $g_day_no % 146097;

    $leap = true;
    if ($g_day_no >= 36525) {
        /* 36525 = 365*100 + 100/4 */
        $g_day_no--;
        $gy +=
            100 * div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
        $g_day_no = $g_day_no % 36524;

        if ($g_day_no >= 365) {
            $g_day_no++;
        } else {
            $leap = false;
        }
    }

    $gy += 4 * div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
    $g_day_no %= 1461;

    if ($g_day_no >= 366) {
        $leap = false;

        $g_day_no--;
        $gy += div($g_day_no, 365);
        $g_day_no = $g_day_no % 365;
    }

    for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++) {
        $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
    }
    $gm = $i + 1;
    $gd = $g_day_no + 1;
    if ($str) {
        return $gy . "/" . $gm . "/" . $gd;
    }
    return [$gy, $gm, $gd];
}

function getJalaliMonth($date)
{
    $d = strtotime($date);
    $monthNames = [
        "فروردین",
        "اردیبهشت",
        "خرداد",
        "تیر",
        "مرداد",
        "شهریور",
        "مهر",
        "آبان",
        "آذر",
        "دی",
        "بهمن",
        "اسفند",
    ];

    return $monthNames[(int)date("m", $d) - 1];
}

function comparedate($_date_mix_jalaly, $_date_mix_gregorian)
{
    $_date_arr_jalaly = explode("/", $_date_mix_jalaly);
    $_date_arr_gregorian = explode("/", $_date_mix_gregorian);

    $arr_jtg = jalali_to_gregorian(
        $_date_arr_jalaly[0],
        $_date_arr_jalaly[1],
        $_date_arr_jalaly[2]
    );

    if ($_date_arr_gregorian[0] > $arr_jtg[0]) {
        return false;
    } elseif (
        $_date_arr_gregorian[0] == $arr_jtg[0] &&
        $_date_arr_gregorian[1] > $arr_jtg[1]
    ) {
        return false;
    } elseif (
        $_date_arr_gregorian[0] == $arr_jtg[0] &&
        $_date_arr_gregorian[1] == $arr_jtg[1] &&
        $_date_arr_gregorian[2] > $arr_jtg[2]
    ) {
        return false;
    }
    return true;
}

function getProfileURL()
{
    if (Auth::check()) {
        $img = Auth::user()->profile_img;
        if ($img) {
            return asset("storage/images/" . $img);
        }
    }
    return asset("storage/images/default.png");
}

function getUserProfileURL($user)
{
    $img = $user->profile_img;
    if ($img) {
        return asset("storage/images/" . $img);
    }

    return asset("storage/images/default.png");
}

/**
 * @param User $user
 * @return string
 */
function getPersianRole(User $user)
{
    $role = $user->role;
    if ($role === "admin") {
        return "ادمین";
    } elseif ($role === "professor") {
        return "استاد";
    } elseif ($role === "student") {
        return "دانشجو";
    } else {
        return "نقش یافت نشد!";
    }
}

function ustrlen($text)
{
    if (function_exists("mb_strlen")) {
        return mb_strlen($text, "utf-8");
    }
    return count(preg_split("//u", $text)) - 2;
}


function models_to_array($models): array
{
    $res = collect();
    foreach ($models as $m) {
        $res = $res->concat(tokenizer($m->name));
    }
    return $res->all();
}

function arraySimilarityToString($arr, $str)
{
    $sim = 0;
    foreach ($arr as $item) {
        similar_text($str, $item->name, $percent);
        $sim = max($percent, $sim);
    }
    return $sim;
}

function cosineSimilarity($tokensA, $tokensB)
{
    Log::info("\nInterests : ", $tokensA);
    Log::info("\nAbstract : ", $tokensB);
    $a = $b = $c = 0;
    $uniqueTokensA = $uniqueTokensB = [];

    $uniqueMergedTokens = array_unique(array_merge($tokensA, $tokensB));

    foreach ($tokensA as $token) {
        $uniqueTokensA[$token] = 0;
    }
    foreach ($tokensB as $token) {
        $uniqueTokensB[$token] = 0;
    }

    foreach ($uniqueMergedTokens as $token) {
        $x = isset($uniqueTokensA[$token]) ? 1 : 0;
        $y = isset($uniqueTokensB[$token]) ? 1 : 0;
        $a += $x * $y;
        $b += $x;
        $c += $y;
    }
    return $b * $c != 0 ? $a / sqrt($b * $c) : 0;
}

function tokenizer($text)
{
    return preg_split(
        '/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/u',
        $text,
        -1,
        PREG_SPLIT_NO_EMPTY
    );
}

function deleteStopWords($words)
{
    $persianStopWords = preg_split(
        "/\r\n|\r|\n/",
        Storage::disk("local")->get("stopWords.txt")
    );
    $res = [];
    foreach ($words as $w) {
        if (!in_array($w, $persianStopWords)) {
            $res[] = $w;
        }
    }
    return $res;
}

/**
 * @param Defense $defense
 * @param User $user
 * @param $word
 * @return array
 */
function containers(Defense $defense, User $user, $word)
{
    $c = [];
    if (str_contains($defense->title, $word)) {
        $c[] = true;
    }
    if (str_contains($defense->subject->name, $word)) {
        $c[] = true;
    }
    foreach ($defense->keywords as $keyword) {
        if (str_contains($keyword->name, $word)) {
            $c[] = true;
        }
    }

    return $c;
}

/**
 * @param Defense $defense
 * @param User $user
 * @return float|int
 */
function similarityAnalyzer(Defense $defense, User $user)
{
    $text = strip_tags($defense->abstract);
    $text = iconv(mb_detect_encoding($text), "utf-8", $text);
    $words = tokenizer($text);
    $keywords = deleteStopWords($words);
    $uniqueWords = array_unique($keywords); // $keywords is the $words array after being filtered as mentioned in step 3
    $uniqueWordCounts = array_count_values($keywords);
    $values = [];
    foreach ($uniqueWords as $w) {
        $density = $uniqueWordCounts[$w] / count($words);
        $keys = array_keys($words, $w);
        $positionSum = array_sum($keys) + count($keys);
        $prominence =
            (count($words) - ($positionSum - 1) / count($keys)) *
            (100 / count($words));
        $containers = containers($defense, $user, $w);
        $values[$w] =
            (float)((1 + $density) * ($prominence / 10)) *
            (1 + 0.5 * count($containers));
    }
    $max_value = max($values);
    foreach ($values as $key => $value) {
        $values[$key] = ($value * 100) / $max_value;
    }
    $res = [];
    foreach ($values as $key => $value) {
        $interests = models_to_array($user->interests);

        if ($value > 50 && in_array($key, $interests, true)) {
            $res[$key] = $value;
        }
    }
    $contentSim = collect($res)->avg();
    $subjectSim = subjectSimilarity($user, $defense->subject) * 100;
    return ($contentSim + $subjectSim) / 2;
}

/**
 * @param User $user
 * @param Subject $subject
 * @return int|mixed
 */
function subjectSimilarity(User $user, Subject $subject)
{
    $sdots = Similarity::dot(
        collect(models_to_array($user->interests))
            ->unique()
            ->values()
            ->all()
    );
    $ifields = collect();
    foreach ($user->interests as $interest) {
        $ifields = $ifields->concat(tokenizer($interest->field->name));
    }
    $ifields = $ifields
        ->unique()
        ->values()
        ->all();
    $fdots = Similarity::dot($ifields);
    $sres = 0;
    $fres = 0;

    foreach ($user->interests as $i) {
        $sval = Similarity::cosine(
            tokenizer($subject->name),
            tokenizer($i->name),
            $sdots
        );
        $fval = Similarity::cosine(
            tokenizer($subject->field->name),
            tokenizer($i->field->name),
            $fdots
        );
        $sres = max($sres, $sval);
        $fres = max($fres, $fval);
    }
    return ($sres + 4 * $fres) / 5;
}

/**
 * @param User $user
 * @param Defense $defense
 * @return void
 */
function sendSMS(User $user, Defense $defense): void
{
    $myApi = new ConnectToApi(env("SMS_API_MAIN_URL"), env("SMS_API_KEY"));

    // مدل ورودی


    // تعریف مدل ورودی
    $req = new SendSms_Req();
    $req->SmsBody = "";
    if ($user->role === "admin") {
        $req->SmsBody .= "ادمین گرامی\n";
    } elseif ($user->role === "professor") {
        $req->SmsBody .= "استاد گرامی\n";
    } elseif ($user->role === "student") {
        $req->SmsBody .= "دانشجوی گرامی\n";
    }
    $req->SmsBody .=
        "اطلاعیه دفاع جدیدی بر اساس علاقه مندی های شما یافت شد برای اطلاعات بیشتر به سایت مراجعه کنید\n عنوان دفاع :\n";
    $req->SmsBody .= $defense->title . "\n";
    //    $req->SmsBody .= route('defenses.show',$defense->id) . "\n"; // for adding link of the defense to SMS uncomment this line
    $req->SmsBody .=
        "\n\n باتشکر، سیستم اطلاع رسانی دفاع پایان نامه دانشگاه شیراز";

    $req->Mobiles = ["09301786784"];

    $res = $myApi->Exec("Message/SendSms", $req);
}

/**
 * @param Field $field
 * @return Collection
 */
function getFieldDefenses(Field $field)
{
    $res = collect();
    foreach (Defense::all() as $d) {
        if (
            $d->student->field->id === $field->id ||
            $d->subject->field->id === $field->id
        ) {
            $res->push($d);
        }
    }
    return $res;
}

/**
 * @param Department $department
 * @return Collection
 */
function getDepratmentDefenses(Department $department)
{
    $res = collect();
    foreach (Defense::all() as $d) {
        if (
            $d->student->field->department->id === $department->id ||
            $d->subject->field->department->id === $department->id ||
            $d->professor->department->id === $department->id
        ) {
            $res->push($d);
        }
    }
    return $res;
}

/**
 * @param User $user
 * @return Collection
 */
function getRelatedDefenseIds(User $user)
{
    if ($user->role === "professor") {
        return Defense::whereIn(
            "subject_id",
            Subject::select("id")
                ->whereIn(
                    "field_id",
                    Field::select("id")
                        ->where(
                            "department_id",
                            $user->professor->department->id
                        )
                        ->get()
                )
                ->get()
        )
            ->select("id")
            ->get();
    } elseif ($user->role === "student") {
        return Defense::whereIn(
            "subject_id",
            Subject::select("id")
                ->where("field_id", $user->student->field->id)
                ->get()
        )
            ->select("id")
            ->get();
    }
    return Defense::select("id")->get();
}

/**
 * @param User $user
 * @return Collection
 */
function getRelatedSubjectIds(User $user)
{
    if ($user->role === "professor") {
        return Subject::whereIn(
            "field_id",
            Field::select("id")
                ->where("department_id", $user->professor->department->id)
                ->get()
        )
            ->select("id")
            ->get();
    } elseif ($user->role === "student") {
        return Subject::where("field_id", $user->student->field->id)
            ->select("id")
            ->get();
    }
    return Subject::select("id")->get();
}


function getOnlineStudents(): Collection
{
    $stds = collect();
    foreach (Student::all() as $s) {
        if ($s->user->isOnline()) {
            $stds->push($s);
        }
    }
    return $stds;
}

function getOnlineProfessors(): Collection
{
    $profs = collect();
    foreach (Professor::all() as $p) {
        if ($p->user->isOnline()) {
            $profs->push($p);
        }
    }
    return $profs;
}

function getOnlineAdmins(): Collection
{
    $admins = collect();
    foreach (Admin::all() as $a) {
        if ($a->user->isOnline() && $a->user->id !== Auth::user()->id) {
            $admins->push($a);
        }
    }
    return $admins;
}
