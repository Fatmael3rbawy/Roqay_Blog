<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GitHubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGithubCallback()
    {
        // try {
            $user = Socialite::driver('github')->user();
            // dd($user);
            // $user = Socialite::driver('github')->user();
            $finduser = User::where('github_id', $user->id)->first();
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->intended('dashboard');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => "fatma",
                        'github_id'=> $user->id,
                        'password' => Hash::make('fffffggg')
                    ]);
        
                Auth::login($newUser);
                dd(Auth::user());
        // return 'ok';
                 return redirect()->intended('dashboard');
            }
        
        // } catch (Exception $e) {
        //     dd($e->getMessage());
        // }
    }
}