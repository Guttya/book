<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('tests', TestController::class);

//    Route::get('/', function (Request $request) {
//
//        $product = Book::where( function($query) use($request){
//            return @$request->author_id ?
//                $query->from('authors')->where('id', $request->id) : '';
//        })->where(function($query) use($request){
//            return @$request->genre_id ?
//                $query->from('genres')->where('id', $request->id) : '';
//        })
//            ->with('authors','genres')
//            ->get();
//
//        $selected_id = [];
//        @$selected_id['authors'] = $request->author_id;
//        @$selected_id['genres'] = $request->genre_id;
//
//        return view('books.index', @compact('books','selected_id'));
//
//    })->name('filter');
});


