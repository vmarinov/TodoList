<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('todo_id');
            $table->text('description')->unique();
            $table->boolean('completed')->default(0);
            $table->boolean('disabled')->default(0);
            $table->timestamp('deadline')->nullable();
            $table->timestamps();

            $table->foreign('todo_id')
            ->references('id')
            ->on('todos')
            ->onDelete('cascade');
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
}
