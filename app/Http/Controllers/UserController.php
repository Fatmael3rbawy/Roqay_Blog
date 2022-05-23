<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.profile');
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
    return view('users.edit')  ;      
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
            'name'=> 'required|string|min:3',
            'email'=> 'required|email',
            'image' =>'image'
        ]);

        $user = User::find($id);
        $image_name = $user->image;
        // check if user upload image or not
        if ($request->hasFile('image')) {
            // check if user has image or not
            if ($image_name !== null) {
                unlink(public_path('images/users/') . $image_name);
            }
            //store user image in public/images/users
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = "user" . uniqid() . ".$ext";
            $image->move(public_path('images/users'), $image_name);
        }
        $user->update([
            'name' =>$request->name,
            'email' =>$request->email,
            'image' =>$image_name
        ]);

        return redirect(route('user.profile'))->with('message','Your profile has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/');
    }
}
