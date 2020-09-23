<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Reply;

class FavoriteReplyController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param App\Models\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function store(Reply $reply) {
        if($reply->addFavorite()) {
            return $this->responseOk();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply) {
        if($reply->removeFavorite()) {
            return $this->responseOk();
        }
    }

    protected function responseOk() {
        return response()->json([
            'success' => true,
        ], JsonResponse::HTTP_CREATED);
    }
}
