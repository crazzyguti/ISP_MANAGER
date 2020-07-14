<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Location;
use App\Device;

class UsersController extends Controller
{

    protected $users;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $this->users = $users = User::where('firtName', 'LIKE', "%$keyword%")
                ->orWhere('lastName', 'LIKE', "%$keyword%")
                ->orWhere('email_phone', 'LIKE', "%$keyword%")
                ->orWhere('gender', 'LIKE', "%$keyword%")
                ->orWhere('birthday', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $this->users = $users = User::latest()->paginate($perPage);
        }

        return view('admin.user.index', compact('users'));
    }

    public function GetUsers()
    {
       $this->user = User::all();
        return $this->Users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        User::create($requestData);

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $locations = Location::all();
        $user = User::find($user)->first();
        $params = [
            "user" => $user,
            "locations" => $locations
        ];

         return view('admin.user.show',  $params );


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user)->first();
        $params = [
            "user" => $user,
        ];

         return view('admin.user.edit',  $params );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $requestData = $request->all();

        $dUser = User::findOrFail($user);
        $dUser->update($requestData);

        return redirect('admin/users')->with('flash_message', 'User is Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
