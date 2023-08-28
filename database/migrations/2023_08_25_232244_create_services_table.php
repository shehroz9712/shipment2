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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('home_para')->nullable();
            $table->string('icon')->nullable();
            $table->string('bg_image')->nullable();
            $table->text('we_offer')->nullable();
            $table->string('we_offer_heading')->nullable();
            $table->string('step_heading_1')->nullable();
            $table->text('step_1')->nullable();
            $table->string('step_heading_2')->nullable();
            $table->text('step_2')->nullable();
            $table->string('step_heading_3')->nullable();
            $table->text('step_3')->nullable();
            $table->string('step_heading_4')->nullable();
            $table->text('step_4')->nullable();
            $table->string('step_heading_5')->nullable();
            $table->text('step_5')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->text('meta_desc')->nullable();
            $table->string('meta_title')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('services');
    }
};
