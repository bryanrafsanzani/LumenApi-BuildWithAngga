<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'name'  =>  'required|max:181',
            'email' =>  'required|email|max:181|unique:users,email',
            'password'  =>  'required|min:8|max:181'
        ]);

        $request['password'] =Hash::make($request->password);

        User::Create($request->only('name', 'email', 'password'));
        return response()->json([
            'msg'   =>  'success Register new user'
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' =>  'required|email',
            'password'  =>  'required|min:8|max:181'
        ]);

        $user = User::where('email', $request['email'])->first();

        if (!$user) {
            return response([
                'email' => ['Your email and/or password do not match']
            ], 400);
        }

        if (Hash::check($request['password'], $user->password)) {
            return response([
                'user' => $user,
                'msg'   => 'Succes Login'
            ], 200);
        }

        return response([
                'email' => ['Your email and/or password do not match']
        ], 400);

    }
}