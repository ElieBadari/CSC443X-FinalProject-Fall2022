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
        Schema::create('games', function (Blueprint $table) {
            $table->id('game_id');
            $table->string('game_name');
            $table->text('pic_url');
            $table->integer('category_id');
            // $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('games_categories', function (Blueprint $table) {
            $table->id('games_categories_id');
            $table->string('category_name');
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
        Schema::dropIfExists('games');
        SChema::dropIfExists('games_categories');
    }
};
