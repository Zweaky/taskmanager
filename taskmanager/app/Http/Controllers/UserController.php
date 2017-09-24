<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['index','show']);
    }

    /**
    * Changes the password of the user.
    *
    * @return \Illuminate\Http\Response
    */
    public function changePassword(Request $request)
    {
        $this->validate(
            $request,[
                'oldpassword' => 'required',
                'password' => 'required|min:6',
                'password2' => 'required|min:6',
            ]
        );

        $hashedPassword = auth()->user()->password;

        if (Hash::check($request->get('oldpassword'),$hashedPassword)) {
            auth()->user()->password = Hash::make($request->get('password'));
            auth()->user()->save();

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(['oldpassword' => 'Your actual password does not correspond with the one you provided.']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'email' => 'nullable|unique:users,email|email|min:6|max:255',
            'username' => 'nullable|unique:users,name|min:3|max:255',
        ]);

        if ($request->get('username') !== null) {
            auth()->user()->name = $request->get('username');
        }

        if ($request->get('email') !== null) {
            auth()->user()->email = $request->get('email');
        }

        auth()->user()->save();

        $request->session()->flash('alert',TRUE);
        $request->session()->flash('type','alert-success');
        $request->session()->flash('msg','Operation Successfull !');

        return redirect("/home");
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
