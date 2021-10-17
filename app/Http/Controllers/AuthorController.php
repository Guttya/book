<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Author $author
     * @return View
     */
    public function index(Author $author): View
    {
        $authors = Author::orderBy('id', 'DESC')->paginate(15);

        return view('authors.index', [
            'authors' => $authors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorRequest $request
     * @return RedirectResponse
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $path = $request->file('avatar')->store('avatars');

        $data = $request->all();
        $data['avatar'] = $path;

        $author = Author::create($data);

        return redirect(route('authors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return View
     */
    public function show(Author  $author): View
    {
        return view('authors.show', [
            'author' => $author,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return View
     */
    public function edit(Author  $author): View
    {
        return view('authors.edit', [
            'author' => $author,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorRequest $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $validated = $request->validated();

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            Storage::delete($author->avatar);

            $path = $request->file('avatar')->store('avatars');

            $data['avatar'] = $path;
        } else {
            unset($data['avatar']);
        }

        $author->update($data);

        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Author $author
     * @return RedirectResponse
     */
    public function destroy(Request $request, Author $author): RedirectResponse
    {
        try {
            $author->delete();
            Storage::delete($author->avatar);
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Автор не может быть удален потому что привязан к книге!');
        }

        return redirect(route('authors.index'));
    }
}
