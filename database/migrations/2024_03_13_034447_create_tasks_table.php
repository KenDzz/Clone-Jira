<?php

use App\Enums\PriorityType;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('level_id')->constrained('levels');
            $table->string('name');
            $table->longText('describes')->nullable();
            $table->foreignId('project_id')->constrained('projects');
            $table->enum('priority', [PriorityType::Low, PriorityType::Medium, PriorityType::High]);
            $table->dateTime('start_time');
            $table->dateTime('estimate_time');
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
        Schema::dropIfExists('tasks');
    }
};
