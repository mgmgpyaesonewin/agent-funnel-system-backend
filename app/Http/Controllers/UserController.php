<?php

namespace App\Http\Controllers;

use App\Applicant;
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

    public function get_bdm_list()
    {
        return User::select('id', 'name')->where('is_bdm', 1)->get();
    }

    public function users()
    {
        $users = User::whereNull('partner_id')->get();

        return UserResource::collection($users);
    }

    public function index(Request $request)
    {
        $name = $request->name;
        $partner = $request->partner;
        $email = $request->email;

        $users = User::with('partner')->where('id', '<>', 1);

        if (!empty($name)) {
            $users->where('name', 'like', '%'.$name.'%');
        }

        if (!empty($email)) {
            $users->where('email', '=', $email);
        }

        if (!empty($partner)) {
            $users->whereHas('partner', function ($users) use ($partner) {
                $users->where('company_name', 'like', '%'.$partner.'%');
            });
        }

        $users = $users->paginate(20);

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $partners = Partner::select('id', 'company_name')->get();

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

        if (isset($request->partner_id)) {
            $data['partner_id'] = $request->partner_id;
        }

        if (isset($request->user_id)) {
            $data['user_id'] = $request->user_id;
        }

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
        $bdm_list = User::select('id', 'name')->where('is_bdm', 1)->get();

        return view('pages.users.edit', compact('user', 'partners', 'bdm_list'));
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

        if (isset($request->partner_id)) {
            $data['partner_id'] = $request->partner_id;
        }

        unset($data['role']);

        $user->is_admin = 0;
        $user->is_bdm = 0;
        $user->is_ma = 0;
        $user->is_staff = 0;
        $user->save();

        $user->update($data);

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $check = Applicant::where('assign_admin_id', $user->id)->orwhere('assign_bdm_id', $user->id)->orwhere('assign_ma_id', $user->id)->count();

        if (0 == $check) {
            $user->delete();

            return redirect('/users')->with('status', 'Successfully deleted a user');
        }

        return redirect('/users')->withErrors(['You cannot delete this user because he/she is assigned to applicants.']);
    }
}
