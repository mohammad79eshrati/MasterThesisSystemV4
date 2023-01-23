<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email")->unique();
            $table->string("profile_img")->nullable();
            $table->string("phone")->nullable();
            $table->string("password");
            $table->date("birth_date");
            $table->boolean("email_notif")->default(true);
            $table->boolean("phone_notif")->default(false);
            $table->enum("role", ["admin", "student", "professor"]);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
    }
};
