<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\User;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['registerUser']]);
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function getProfile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function getUserById($id)
    {
        if (!$user = User::findOrFail($id)) {
            return response()->json(['message' => 'User not found!'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    /**
     * Create a new user.
     *
     * @param Request $request
     * @return Response
     */
    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->password = app('hash')->make($request->input('password'));

        if (!$user->save()) {
            return response()->json(['message' => 'Failed to create user!'], 409);
        }

        return response()->json(['user' => $user, 'message' => 'User created.'], 201);
    }
}
