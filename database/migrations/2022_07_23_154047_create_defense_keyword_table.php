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
        Schema::create("defense_keyword", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("defense_id")
                ->references("id")
                ->on("defenses")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table
                ->foreignId("keyword_id")
                ->references("id")
                ->on("keywords")
                ->onDelete("cascade")
                ->onUpdate("cascade");
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
        Schema::dropIfExists("defense_keyword");
    }
};
