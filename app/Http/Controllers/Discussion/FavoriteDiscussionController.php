<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Discussion;

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
        if($discussion->addFavorite()) {
            return $this->responseOk();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion) {
        if($discussion->removeFavorite()) {
            return $this->responseOk();
        }
    }

    protected function responseOk() {
        return response()->json([
            'success' => true,
        ], JsonResponse::HTTP_CREATED);
    }
}
