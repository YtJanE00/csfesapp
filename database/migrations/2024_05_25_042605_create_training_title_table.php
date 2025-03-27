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
        Schema::create('training_title', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('office');
            $table->string('speaker');
            $table->string('training_month');
            $table->string('training_day');
            $table->string('training_year');
            $table->string('training_venue');
            $table->text('surveylink');
            $table->integer('postedBy');
            $table->rememberToken();
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
        Schema::dropIfExists('training_title');
    }
};
