<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('tasks_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('descripition');
            $table->dateTime('completionDate');
           
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('task_status_id')->unsigned();
            $table->foreign('task_status_id')->references('id')->on('tasks_status'); 
            
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
        Schema::dropIfExists('tasks_lists');
    }
}
