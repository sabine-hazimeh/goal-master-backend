<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(Request $request)
{
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:8',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $profilePhotoPath = null;
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $profilePhotoPath = $file->store('profile_photos', 'public');
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'profile_photo' => $profilePhotoPath,
    ]);

    return response()->json(['message' => 'User created successfully'], 201);
}
public function registerConsultant(Request $request)
{
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:8',
        'phone_number' => 'required|string',
        'description' => 'required|string',
        'experience' => 'required|integer|min:0',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $profilePhotoPath = null;
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $profilePhotoPath = $file->store('profile_photos', 'public');
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'consultant',
        'phone_number' => $request->phone_number,
        'description' => $request->description,
        'experience' => $request->experience,
        'profile_photo' => $profilePhotoPath,
    ]);

    return response()->json(['message' => 'Consultant created successfully'], 201);
}

    
    /**
     * Authenticate the user and return a JWT token if valid credentials are provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $credentials = $request->only('email', 'password');
    
        try {
            $token = JWTAuth::attempt($credentials);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $user = JWTAuth::user();
        $ttl = config('jwt.ttl') * 60; 
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl,
            'user' => $user
        ]);
    }
    
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
    public function refresh()
    {
        $token = Auth::refresh();

        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
 /**
     * Respond with a JWT token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    /**
     * Get the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        
        $user = Auth::user();
        return response()->json($user);
    }
    public function DisplayConsultants(){
        $consultants = User::where('role', 'consultant')->get();
        return response()->json(["consultants: ",$consultants],200);
    }

    public function DisplayUsers(){
        $users = User::where('role', 'user')->get();
        return response()->json(["users: ",$users],200);
    }
}
