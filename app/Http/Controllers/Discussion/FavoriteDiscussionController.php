<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Discussion;
use Auth;

class FavoriteDiscussionController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param App\Models\Discussion $discussion
     * @return \Illuminate\Http\Response
     */
    public function store(Discussion $discussion) {
        $userId = Auth::user()->id;
        if(!$discussion->favorites()->where('user_id', $userId)->exists()) {
            $discussion->favorites()->create([
                'user_id' => Auth::user()->id
            ]);
            return response()->json([
                'success' => true,
            ], JsonResponse::HTTP_CREATED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion) {
        $userId = Auth::user()->id;
        if($discussion->favorites()->where('user_id', $userId)->delete()) {
            return response()->json([
                'success' => true,
            ], JsonResponse::HTTP_OK);
        }
    }
}
