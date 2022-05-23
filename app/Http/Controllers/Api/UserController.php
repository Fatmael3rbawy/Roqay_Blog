<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{ 
    use GeneralTrait;

    public function update(Request $request ,$id)
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
                unlink(public_path('images/Api/users/') . $image_name);
            }
            //store user image in public/images/users
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $image_name = "user" . uniqid() . ".$ext";
            $image->move(public_path('images/Api/users'), $image_name);
        }
        $user->update([
            'name' =>$request->name,
            'email' =>$request->email,
            'image' =>$image_name
        ]);

        return $this->returnSuccessMessage('Your profile has been updated successfully');
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
        return $this->returnSuccessMessage('Your profile has been deleted');
    }
}
