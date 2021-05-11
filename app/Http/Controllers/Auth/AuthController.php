<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class AuthController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    /**
     * Revoke token from the database
     */
    public function revokeToken() {
        $user = auth()->user();

        /** Revoke current access token */
        $user->currentAccessToken()->delete();

        /** Revoke all tokens belongs to current user */
        //$user->tokens()->delete();
        return response()->json([
            'message'   => 'Token has been revoked!'
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Get authenticated user
     */
    public function getAuthenticatedUser() {
        try {
            $user = auth()->user();
            return new UserResource($user);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
