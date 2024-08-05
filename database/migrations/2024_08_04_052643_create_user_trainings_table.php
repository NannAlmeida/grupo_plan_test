<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trainings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id', false, true);
            $table->bigInteger('training_id', false, true);
            $table->enum('status', ['I', 'A', 'C']);
            $table->decimal('progress')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('note')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('training_id')->references('id')->on('trainings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_trainings');
    }
}
