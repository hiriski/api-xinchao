<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Auth\LoginUser as LoginRequest;
use Auth;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request)
    {

        $user            = null;
        $deviceName      = $request->device_name;
        $usernameOrEmail = $request->username_or_email;
        $tokenName       = $deviceName !== null ? $deviceName : $usernameOrEmail;

        $user = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)
            ? User::where('email', $usernameOrEmail)->first()
            : User::where('username', $usernameOrEmail)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $this->incorrectCredentials(
                'The provided credentials are incorrect.'
            );
        }
        $token = $user->createToken($tokenName)->plainTextToken;
        return $this->responseWithToken($token, $user);
    }

    protected function responseWithToken($token, $user)
    {
        return response()->json([
            'success'     => true,
            'token'       => $token,
            'token_type'  => 'bearer',
            'user'        => new UserResource($user)
        ], JsonResponse::HTTP_OK);
    }

    protected function incorrectCredentials($error)
    {
        throw new HttpResponseException(
            response()->json([
                'success'   => false,
                'message'   => $error
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
