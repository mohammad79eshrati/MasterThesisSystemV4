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
        Schema::create("defenses", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("place");
            $table->text("abstract")->nullable();
            $table->boolean("is_online");
            $table->date("date");
            $table->time("time");
            $table->softDeletes();
            $table
                ->foreignId("creator_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table
                ->foreignId("subject_id")
                ->references("id")
                ->on("subjects")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table
                ->foreignId("prof_id")
                ->references("prof_id")
                ->on("professors")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table
                ->foreignId("std_num")
                ->unique()
                ->references("std_num")
                ->on("students")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("defenses");
    }
};
