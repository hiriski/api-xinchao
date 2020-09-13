<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Auth\LoginUser as LoginRequest;

class LoginController extends Controller {
    
    public function __invoke(LoginRequest $request) {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            $this->incorrectCredentials(
                'The provided credentials are incorrect.'
            );
        }
        $token = $user->createToken($request->email)->plainTextToken;
        return $this->responseWithToken($token, $user);
    }

    protected function responseWithToken($token, $user) {
        return response()->json([
            'success'     => true,
            'token'       => $token,
            'token_type'  => 'bearer',
            'user'        => new UserResource($user)
        ], JsonResponse::HTTP_OK);
    }

    protected function incorrectCredentials($error) {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => $error
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
