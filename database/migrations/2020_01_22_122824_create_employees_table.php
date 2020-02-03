<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 50);
            $table->string('work_phone', 255);
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('email2', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('leader_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
