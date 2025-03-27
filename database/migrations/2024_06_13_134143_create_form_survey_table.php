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
        Schema::create('form_survey', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('name');
            $table->string('office');
            $table->string('contact_information');
            $table->string('question');
            $table->string('question_rate')->nullable();
            $table->text('feedback');
            $table->text('feedback2');
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
        Schema::dropIfExists('form_survey');
    }
};
