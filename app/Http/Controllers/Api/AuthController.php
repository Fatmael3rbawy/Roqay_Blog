<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(Request $request)

    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->returnData('User',  new UserResource($user), 'User has created successfully');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'min:6'],
        ]);
        if ($validator->fails()) {
            return $this->returnValidationError($validator);
        }
        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {
            return $this->returnError('The given data is invalid');
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'access_token' => $token
        ]);
    }

    public function logout()
    {
        Auth::user()->logout;
        return $this->returnSuccessMessage('You are logged out successfully');
    }
}
