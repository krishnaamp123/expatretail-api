<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
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
            'role' => "required|in:admin,retail,supermarket"
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
            'role' => request('role'),
        ]);

        if ($user){
            return response()->json(['message' => 'Successfully Registered']);
        }else{
            return response()->json(['message' => 'Something went wrong']);
        }
    }

    public function index()
    {
        $user = User::all();
        // return response()->json(['data' => $user]);
        return UserResource::collection($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_group' => 'required',
            'email' =>'required|email|unique:users',
            'password' => 'required',
            'customer_name' =>'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'address' => 'required',
        ]);

        $user = User::findorFail($id);
        $user->update($request->all());
        return response()->json(['data' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => $user]);
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

    // public function login(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // If validation fails, redirect back with errors
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Get the email and password from the request
    //     $credentials = $request->only('email', 'password');

    //     // Attempt to log in using the provided credentials
    //     if (!auth()->attempt($credentials)) {
    //         // If login fails, redirect back with an error message
    //         return redirect()->back()->with('error', 'Unauthorized: Invalid email or password')->withInput();
    //     }

    //     // If login is successful, redirect to the desired page
    //     return redirect()->route('dashboard')->with('success', 'Login successful!');
    // }


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
            'expires_in' => null,
            // 'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
