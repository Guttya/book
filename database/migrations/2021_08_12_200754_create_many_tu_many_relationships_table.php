<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManyTuManyRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_cover', function (Blueprint $table) {
            $table->foreignId('book_id')
                ->constrained('books');
            $table->foreignId('cover_type_id')
                ->constrained('cover_types');
        });

        Schema::create('book_genre',
            function (Blueprint $table) {
            $table->foreignId('book_id')
                ->constrained('books');
            $table->foreignId('genre_id')
                ->constrained('genre');
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('book_cover');
        Schema::dropIfExists('book_genre');

        Schema::dropIfExists('many_tu_many_relationships');
    }
}
