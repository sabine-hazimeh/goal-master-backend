<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'profile_photo' => $profilePhotoPath,
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Register a new consultant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

        User::create([
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

    /**
     * Update user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request)
    {
        $rules = [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user = auth()->user();
    
        if ($request->has('name')) {
            $user->name = $request->name;
        }
    
        if ($request->has('email')) {
            $user->email = $request->email;
        }
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->has('profile_photo')) {
            if ($request->profile_photo === null) {
                if ($user->profile_photo && \Storage::exists('public/' . $user->profile_photo)) {
                    \Storage::delete('public/' . $user->profile_photo);
                }
                $user->profile_photo = null;
            } elseif ($request->hasFile('profile_photo')) {
                if ($user->profile_photo && \Storage::exists('public/' . $user->profile_photo)) {
                    \Storage::delete('public/' . $user->profile_photo);
                }
                $file = $request->file('profile_photo');
                $user->profile_photo = $file->store('profile_photos', 'public');
            }
        }
    
        $user->save();
    
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
    

public function show($id)
{
    $consultant = User::find($id);

    if (!$consultant) {
        return response()->json(['message' => 'Consultant not found.'], 404);
    }

    return response()->json(['data' => $consultant]);
}
public function updateConsultant(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'name' => 'sometimes|string|max:255',
        'email' => 'sometimes|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8',
        'phone_number' => 'sometimes|string|max:15',
        'experience' => 'sometimes|integer',
        'description' => 'nullable|string',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Update validation for image files
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $consultant = User::find($id);

    if (!$consultant) {
        return response()->json(['message' => 'Consultant not found.'], 404);
    }

    if ($consultant->role !== 'consultant') {
        return response()->json(['message' => 'User is not a consultant.'], 403);
    }

    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');
        $profilePhotoPath = $file->store('profile_photos', 'public');

        if ($consultant->profile_photo && Storage::disk('public')->exists($consultant->profile_photo)) {
            Storage::disk('public')->delete($consultant->profile_photo);
        }

        $consultant->profile_photo = $profilePhotoPath;
    }

    if ($request->has('name')) {
        $consultant->name = $request->input('name');
    }
    if ($request->has('email')) {
        $consultant->email = $request->input('email');
    }
    if ($request->input('password')) {
        $consultant->password = bcrypt($request->input('password'));
    }
    if ($request->has('phone_number')) {
        $consultant->phone_number = $request->input('phone_number');
    }
    if ($request->has('experience')) {
        $consultant->experience = $request->input('experience');
    }
    if ($request->has('description')) {
        $consultant->description = $request->input('description');
    }

    $consultant->save();

    return response()->json(['message' => 'Consultant updated successfully!', 'data' => $consultant]);
}

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Refresh JWT token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Display consultants.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function displayConsultants()
    {
        $consultants = User::where('role', 'consultant')->get();
        return response()->json(['consultants' => $consultants], 200);
    }

    /**
     * Display users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function displayUsers()
    {
        $users = User::where('role', 'user')->get();
        return response()->json(['users' => $users], 200);
    }
    /**
 * Delete a consultant.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\JsonResponse
 */
public function deleteConsultant($id)
{
 
    $consultant = User::find($id);

    if (!$consultant || $consultant->role !== 'consultant') {
        return response()->json(['error' => 'Consultant not found or unauthorized'], 404);
    }

   
    if ($consultant->profile_photo && \Storage::exists('public/' . $consultant->profile_photo)) {
        \Storage::delete('public/' . $consultant->profile_photo);
    }
    $consultant->delete();

    return response()->json(['message' => 'Consultant deleted successfully'], 200);
}

}
