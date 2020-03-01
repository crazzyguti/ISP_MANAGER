<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Location;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::with('roles')->get();
        $userGroups = User::select(DB::raw('count(*) as user_count, gender'))->where('gender', '<>', 1)->groupBy('gender')->get();
        $paginator = User::paginate(15);
        $phoneValidatorURL = env("PHONE_VALIDATOR");
        $locations = Location::all();
        $params = [
            "users" => $users,
            "userGroups" => $userGroups,
            "paginator" => $paginator,
            "phoneValidatorURL" => $phoneValidatorURL,
            "locations" => $locations
        ];

        return view("admin.user.index", $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $users = User::find($user)->first();
        $params = [
            "users" => $users,
            "locations" => $locations
        ];
        return view("admin.user.show",$params);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
