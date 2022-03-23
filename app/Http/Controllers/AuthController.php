<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $assignedDate = [];
        $assignedDate['user'] = User::where('email', $request->email)->first();
        // $assignedDate['token'] = $this->respondWithToken($token);
        $assignedDate['token'] = $token;
        return $assignedDate;
    }

    // Sender Functions
    public function postEditSenderParcel(Request $request)
    {
        if(response()->json(auth()->user())){
            $parcel = Parcel::where('id', $request->parcel_id)->update([
                'pick_up' => $request->pick_up,
                'drop_off' => $request->drop_off,
                'status' => 'created'
            ]);

            return $parcel;
        }

    }

    // Biker Functions
    public function postEditBikerParcel(Request $request)
    {
        if(response()->json(auth()->user())){
            $parcel = Parcel::where('id', $request->parcel_id)->update([
                'status' => $request->status
            ]);

            return $parcel;
        }

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
