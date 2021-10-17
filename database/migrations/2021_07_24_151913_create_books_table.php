<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
        });

        Schema::create('cover_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->string('file', 255);
            $table->string('preview_img', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->text('description');
            $table->string('avatar', 255);
            $table->timestamps();
        });

        Schema::create('book_author', function (Blueprint $table) {
            $table->foreignId('author_id')
                ->constrained('authors');
            $table->foreignId('book_id')
                ->constrained('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_author');
        Schema::dropIfExists('books');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('genre');
        Schema::dropIfExists('cover_types');
    }
}
