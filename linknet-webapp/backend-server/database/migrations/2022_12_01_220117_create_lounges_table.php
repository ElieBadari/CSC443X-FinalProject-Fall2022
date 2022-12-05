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
        Schema::create('lounges', function (Blueprint $table) {
            $table->id('lounge_id');
            $table->string('type')->default('lounge');
            $table->string('lounge_name');
            $table->text('description');
            $table->text('ratings');
            $table->text('location');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('lounges_pictures', function (Blueprint $table) {
            $table->id('lounges_pictures_id');
            $table->integer('lounge_id');
            $table->text('pic_url');
            $table->integer('pic_order');
            // $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('lounges_ratings', function (Blueprint $table) {
            $table->id('lounges_ratings_id');
            $table->integer('user_id');
            $table->integer('lounge_id');
            $table->double('rating');
            $table->text('review');
            // $table->softDeletes();
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
        Schema::dropIfExists('lounges');
        Schema::dropIfExists('lounges_pictures');
        Schema::dropIfExists('lounges_ratings');
    }
};
