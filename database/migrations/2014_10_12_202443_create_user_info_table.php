<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);

            Schema::enableForeignKeyConstraints();
        });

        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('address');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('phone', 255);
            $table->string('library_card',255);

            $table->unique('user_id');
            $table->foreign('user_id')->references('id')->onDelete('cascade')->on('users');

            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
        Schema::dropIfExists('cities');
    }
}
