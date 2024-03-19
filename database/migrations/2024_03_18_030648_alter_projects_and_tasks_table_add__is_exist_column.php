<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean("is_exist")->default(true);
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean("is_exist")->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn("is_exist");
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn("is_exist");
        });
    }
};
