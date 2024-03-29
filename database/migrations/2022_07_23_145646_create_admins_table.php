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
        Schema::create("admins", function (Blueprint $table) {
            $table->id();
            $table->boolean("is_blocked")->default(false);
            $table->boolean("is_owner")->default(false);
            $table
                ->foreignId("user_id")
                ->unique()
                ->references("id")
                ->on("users")
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
        Schema::dropIfExists("admins");
    }
};
