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
            $table->dropForeign('project_id');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
        });
        Schema::table('user_task', function (Blueprint $table) {
            $table->dropForeign('task_id');
            $table->dropForeign('user_id');
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        Schema::table('user_project', function (Blueprint $table) {
            $table->dropForeign("project_id" );
            $table->dropForeign("user_id" );
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
            $table->dropForeign('project_id');
            $table->foreignId('project_id')->constrained('projects');
        });
        Schema::table('user_task', function (Blueprint $table) {
            $table->dropForeign('task_id');
            $table->dropForeign('user_id');
            $table->foreignId('task_id')->constrained('tasks');
            $table->foreignId('user_id')->constrained('users');
        });
        Schema::table('user_project', function (Blueprint $table) {
            $table->dropForeign("project_id" );
            $table->dropForeign("user_id" );
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('user_id')->constrained('users');
        });
    }
};
