<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::where('slug', 'administrator')->first();
        $staffs = User::where('role_id', $role->id)->paginate(10);
        return view('staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(10)->mixedCase()->numbers()->symbols()],
            'password_confirmation' => ['required'],
            'gender' => ['required', 'in:M,F'],
        ]);

        $role = Role::where('slug', 'administrator')->first();
        $staff = new User();
        $staff->role_id = $role->id;
        $staff->name = $request->name;
        $staff->username = $request->username;
        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->save();

        $profile = new Profile();
        $profile->user_id = $staff->id;
        $profile->gender = $request->gender;
        $profile->save();

        session()->flash('success', 'The staff created successfully.');
        return to_route('staff.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = User::with('profile')->findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username,' . $id],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'gender' => ['required', 'in:M,F'],
        ]);

        $role = Role::where('slug', 'administrator')->first();
        $staff = User::findOrFail($id);
        $staff->role_id = $role->id;
        $staff->name = $request->name;
        $staff->username = $request->username;
        $staff->email = $request->email;
        $staff->save();

        $profile = Profile::where('user_id', $staff->id)->firstOrFail();
        $profile->user_id = $staff->id;
        $profile->gender = $request->gender;
        $profile->save();

        session()->flash('success', 'The staff updated successfully.');
        return to_route('staff.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
