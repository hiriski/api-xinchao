<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialAccount;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Str;

class SocialAccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $requestSocialAccount = $request->only([
            'social_id',
            'social_email',
            'social_name',
            'social_provider',
            'social_photo_url'
        ]);

        $user = User::where('email', $requestSocialAccount['social_email'])->first();
        if($user === null) {
            $socialAccount = new SocialAccount;
            $socialAccount->social_id           = $requestSocialAccount['social_id'];
            $socialAccount->social_name         = $requestSocialAccount['social_name'];
            $socialAccount->social_provider     = $requestSocialAccount['social_provider'];
            $socialAccount->social_photo_url    = $requestSocialAccount['social_photo_url'];

            $user = User::create([
                'name'      => $requestSocialAccount['social_name'],
                'email'     => $requestSocialAccount['social_email'],
                'username'  => $requestSocialAccount['social_name'] . Str::random(5)
            ]);
            $socialAccount->fill(['user_id' => $user->id])->save();
        }

        return new UserResource($user);
    }
}
