<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {
        $request->validated($request->all());   

        
        if (User::where('email', $request->email)->first()) {
            return response([
                'status' => 'error',
                'message' => 'email not found, because email has been taked'
            ]);
        }

        $user = User::create([ //! Add New User
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        
            'firstName' => '',
            'lastName' => '',
            'image' => '',
            'bio' => '',
        ]);

        return response([ //! ENTER MESSAGE & TOKEN
            'status' => 'success',
            'token' => $user->createToken($user->name)->plainTextToken,
        ]);
    }

    public function login(LoginRequest $request ) {
        $request->validated($request->all());

        if (!User::where('email', $request->email)->first()) { //! CHECK EMAIL
            return response([
                'status' => 'error',
                'message' => 'email not found'
            ]);
        }

        if (!Auth::attempt($request->only('email', 'password'))) { //! CHECK PASSWORD
            return response([
                'status' => 'error',
                'message' => 'password not found'
            ]);
        }

        $user = User::where('email', $request->email)->first();

        return response([ //! ENTER MESSAGE & TOKEN
            'status' => 'success',
            'token' => $user->createToken($user->name)->plainTextToken,
        ]);
    }
    public function logout() { //! SIGN OUT
        Auth::user() ->currentAccessToken() -> delete(); //! GET TOKEN & DELETE

        return response([
           'status' =>'success',
        ]);
    }

    public function user($name) { //! Enter User
        $user = User::where('name',$name)->first();

        if ($user) {
            return response([
               'status' =>'success',
                'user' => new UserResource($user),
                // 'user' => ($user)
            ]);
        } 
        return response([
           'status' =>'error',
          'message' => 'user not found'
        ]);
    }

    public function changeUser(UserRequest $request, $name) {
        $Authuser = Auth::user(); //! GET USER
        $user = User::where('name',$name)->first();

        if ($user) {                  
            if ($user->id == $Authuser->id) { //! change user date
                $request->validated($request->all());

                if (User::where('email', $request->email)->first()) {
                    $user->email = $Authuser->email;
                }

                if (User::where('name', $request->name)->first()) {
                    $user->name = $Authuser->name;
                }

                $image = $request->image; //! ADD IMAGE
                $imageName = Str::random(32).'.'.$request->image->getClientOriginalExtension();
                
                $user->email = $request->email;
                $user->name = $request->name;
                $user->password = $request->password;

                $user->firstName = $request->firstName;
                $user->lastName = $request->lastName;
                $user->image = $imageName;
                $user->bio = $request->bio;

                $path = public_path('files/users/'.$user->name); //! GET PATH
                $image -> move($path, $imageName); //! MOVE IMAGE

                $user->save();

                return response([
                    'status' => 'success',
                ]);
            } 
            return response([
                'status' => 'error',
                'message' => "U don't have root for change this user"
            ]);
        } 
        return response([
           'status' =>'error',
          'message' => 'user not found'
        ]);
    }
    public function destroyAccount($name) {
        $Authuser = Auth::user(); //! get Logged User
        $user = User::where('name',$name)->first(); //! get just user

        if ($user) {                
            if ($user == $Authuser) {
                $user->delete(); //! delete user

                return response([
                   'status' =>'success',
                ]);
            } 
            return response([ //! error
                'status' => 'error',
                'message' => "U don't have root for change this user"
            ]);
        } 
        return response([
           'status' =>'error',
          'message' => 'user not found'
        ]);
    }
}
