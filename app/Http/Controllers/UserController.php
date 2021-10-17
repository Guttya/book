<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;



/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::orderBy('id', 'DESC')->paginate(15);

        return view('users.index', [
            'users' => $users,
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
        $cities = City::all();
        $user = null;

        return view('users.create', [
            'cities' => $cities,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $userInfo = new UserInfo($request->all());
        $user = User::create($request->all());
        $user->userInfo()->save($userInfo);

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $cities = City::all();

        return view('users.show', [
            'user' => $user,
            'cities' => $cities,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return View
     */
    public function edit(User $user): View
    {
        $cities = City::all();

        return view('users.edit', [
            'user' => $user,
            'cities' => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return Application|Redirector|RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($request->all());
        $user->userInfo()->update($request->except(['_token', '_method', 'name', 'email']));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(User $user)
    {
        $user->delete();

       return redirect(route('users.index'));
    }


}
