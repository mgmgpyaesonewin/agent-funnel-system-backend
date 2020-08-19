<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Partner;
use App\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllAdmins(Request $request)
    {
        return User::where('is_admin', 1)->get();
    }

    public function users()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    public function index(Request $request)
    {
        $users = User::with('partner')->paginate(20);

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::all();

        return view('pages.users.create', compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data = array_merge($data, [
            'password' => Hash::make($request->validated()['password']),
            $request->validated()['role'] => 1,
        ]);

        unset($data['role']);

        User::create($data);

        return redirect('/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $partners = Partner::all();

        return view('pages.users.edit', compact('user', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        $data = array_merge($data, [
            'password' => Hash::make($request->validated()['password']),
            $request->validated()['role'] => 1,
        ]);

        unset($data['role']);

        $user->update($request->validated());

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/users');
    }
}
