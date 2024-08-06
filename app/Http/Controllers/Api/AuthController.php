<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $credentials = request(['email', 'password']);
        $isApi = $request->is('api/*');

        if ($isApi) {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            return $this->respondWithToken($token);
        } else {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records',
            ]);
        }
        
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request) {
        $isApi = $request->is('api/*');

        if ($isApi) {
            return response()->json(auth('api')->user());
        } else {
            return response()->json(Auth::user());
        }
        
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $isApi = $request->is('api/*');

        if ($isApi) {
            auth('api')->logout();
            return response()->json(['message' => 'Successfully logged out']);
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
<<<<<<< HEAD
    public function refresh(Request $request) {
        $isApi = $request->is('api/*');
        
        /* When access token will be expired, we are going to generate a new one wit this function 
=======
    public function refresh() {
        /* When access token will be expired, we are going to generate a new one with this function 
>>>>>>> 2f4326bf26c000332af59756f5e6373884071d51
        and return it here in response */
        if ($isApi) {
            return $this->respondWithToken(auth()->refresh());
        } else {
            // For web, we don't need to refresh as it uses session-based auth
            return response()->json(['message' => 'Refresh not required for web sessions'], 400);
        }
        
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token) {
        /* This function is used to make JSON response with new
        access token of current user */
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
