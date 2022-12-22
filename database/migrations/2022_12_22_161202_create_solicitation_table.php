<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitation', function (Blueprint $table) {
            $table->id();
            $table->string('title', 300);
            $table->string('description', 10000);
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('type_solicitation');
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
        Schema::dropIfExists('solicitation');
    }
}
