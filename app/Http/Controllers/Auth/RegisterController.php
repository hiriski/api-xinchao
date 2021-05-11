<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Auth\RegisterUser as RegisterRequest;
use Illuminate\Support\Str;

class RegisterController extends Controller {

    public function __invoke(RegisterRequest $request) {
        $credentials = $request->merge([
            'password'  => Hash::make($request->password),
        ])->only(['name', 'username', 'email', 'password']);

        $credentials['username'] = $request->username !== null
            ? Str::slug($request->username)
            : Str::slug($request->name) . '-' . Str::random(3);

        $user = User::create($credentials);
        $token = $user->createToken($user->email)->plainTextToken;;
        return $this->responseWithToken($token, $user);
    }

    protected function responseWithToken($token, $user) {
        return response()->json([
            'success'     => true,
            'token'       => $token,
            'token_type'  => 'bearer',
            'user'        => new UserResource($user)
        ], JsonResponse::HTTP_CREATED);
    }
}
