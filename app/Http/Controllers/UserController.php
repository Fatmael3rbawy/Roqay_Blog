<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\UserRepositoryInterface;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepoInterface;
    public function __construct( UserRepositoryInterface $userRepoInterface){
        $this->userRepoInterface = $userRepoInterface;
    }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('users.edit');
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
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'image' => 'image'
        ]);
        
        $image_name = Auth::user()->image;
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
        $attributes= [
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image_name
        ];

        $this->userRepoInterface->update($attributes , auth()->user()->id);
         
        return redirect(route('user.profile'))->with('message', 'Your profile has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->userRepoInterface->delete(auth()->user()->id);
        return redirect('/dashboard');
    }
}
