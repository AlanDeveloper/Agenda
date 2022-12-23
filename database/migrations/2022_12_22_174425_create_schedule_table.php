<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employee');
            $table->unsignedBigInteger('solicitation_id');
            $table->foreign('solicitation_id')->references('id')->on('solicitation');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}
