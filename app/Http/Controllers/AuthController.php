<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }

    public function register()
    {
        $validator = Validator::make(request()->all(),[
            'id_group' => 'required',
            'email' =>'required|email|unique:users',
            'password' => 'required',
            'customer_name' =>'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'id_group' => request('id_group'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'customer_name' => request('customer_name'),
            'pic_name' => request('pic_name'),
            'pic_phone' => request('pic_phone'),
            'address' => request('address'),
        ]);

        if ($user){
            return response()->json(['message' => 'Successfully Registered']);
        }else{
            return response()->json(['message' => 'Something went wrong']);
        }
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        if (empty($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully Logged Out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = Auth::user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
