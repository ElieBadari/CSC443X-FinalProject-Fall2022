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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->integer('user_type_id')->default('2');//default user is a gamer unless said otherwise, 0=>admin,1=>lounge,2=>gamer
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('locations')->default(null);
            $table->text('pic_url')->default(null);
            $table->text('bio')->default(null);
            $table->timestamps();
            $table->softDeletes();
            //$table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
