<?php

namespace App\Http\Controllers\Auth;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LogoutController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    public function __invoke() {
        $user = Auth::user();

        /** Revoke current access token */
        $user->currentAccessToken()->delete();

        /** Revoke all tokens belongs to current user */
        //$user->tokens()->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Successfully logged out!'
        ], Response::HTTP_OK);
    }
}
