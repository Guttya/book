<?php

namespace App\Http\Controllers;


use App\Http\Filters\BookFilter;
use App\Http\Requests\BookRequest;

use App\Http\Requests\FilterRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\CoverType;
use App\Models\Genre;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FilterRequest $request
     * @return View
     * @throws BindingResolutionException
     */
    public function index(FilterRequest $request): View
    {
        $data = $request->validated();

        $filter = app()->make(BookFilter::class, ['queryParams' => array_filter($data)]);

        $books = Book::filter($filter)->paginate(1);
        $authors = Author::all();
        $genres = Genre::all();


//        $author = Author::find(3);
//
//        foreach ($author->books as $books) {
//           echo $books;
//        }




        return view('books.index', [
            'books' => $books,
            'authors' => $authors,
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @return View
     */
    public function create(): View
    {
        $authors = Author::all();
        $coverTypes = CoverType::all();
        $genres = Genre::all();

        return view('books.create', [
            'authors' => $authors,
            'coverTypes' => $coverTypes,
            'genres' => $genres,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookRequest $request
     * @return Application|Redirector|RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $validated = $request->validated();

        $pathFile = $request->file('file')->store('book');
        $pathImg = $request->file('preview_img')->store('imageBook');

        $data = $request->all();
        $data['file'] = $pathFile;
        $data['preview_img'] = $pathImg;

        $book = Book::create($data);

        $book->authors()->sync($data['authors']);
        $book->covers()->sync($data['cover_types']);
        $book->genres()->sync($data['genres']);


        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return View
     */
    public function show(Book $book): View
    {
        return view('books.show', [
            'book' => $book,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Book  $book
     * @return View
     */
    public function edit(Book $book): View
    {
        $authors = Author::all();
        $coverTypes = CoverType::all();
        $genres = Genre::all();

        return view('books.edit', [
            'book' => $book,
            'authors' => $authors,
            'coverTypes' => $coverTypes,
            'genres' => $genres,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookRequest  $request
     * @param  Book  $book
     * @return Application|Redirector|RedirectResponse
     */
    public function update(BookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $data = $request->all();

        if ($request->hasFile('file')) {
            Storage::delete($book->file);

            $pathFile = $request->file('file')->store('public/book');

            $data['file'] = $pathFile;
        } else {
            unset($data['file']);
        }

        if ($request->hasFile('preview_img')) {
            Storage::delete($book->preview_img);

            $pathImg = $request->file('preview_img')->store('public/imageBook');

            $data['preview_img'] = $pathImg;
        } else {
            unset($data['preview_img']);
        }

        $book->update($data);

        if ($request->has('authors')) {
            $book->authors()->sync($data['authors']);
        }
        if ($request->has('cover_types')) {
            $book->covers()->sync($data['cover_types']);
        }
        if ($request->has('cover_types')) {
            $book->genres()->sync($data['genres']);
        }

        return redirect(route('books.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Book $book, Request $request): RedirectResponse
    {
        $book->authors()->detach($book->authors);
        $book->genres()->detach($book->genre);
        $book->covers()->detach($book->cover);

        try {
            $book->delete();
            Storage::delete($book->file);
            Storage::delete($book->preview_img);
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('error', 'Книга не может быть удалена потому что привязана к автору!');
        }

        return redirect(route('books.index'));
    }
}

