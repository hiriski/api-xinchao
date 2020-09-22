<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Requests\Discussion\StoreReply as ReplyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Discussion;
use App\Models\Reply;
use Auth;

class ReplyController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum');
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  App\Http\Requests\StoreReply  $request
     * @param App\Http\Controllers\Discussion  $discussion
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(
        ReplyRequest $request,
        Discussion $discussion
    ) {
        $reply = $request->merge([
            'user_id' => Auth::user()->id,
            'discussion_id' => $discussion->id
        ])->only(['content', 'user_id', 'discussion_id']);

        $discussion->replies()->create($reply);

        return $this->responseWithStatus(
            true,
            'You have replied successfully.',
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *  
     * @param App\Http\Requests\StoreReply  $request
     * @param App\Http\Controllers\Discussion  $discussion
     * @param App\Http\Controllers\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(
        ReplyRequest $request,
        Discussion $discussion,
        Reply $reply
    ) {
        $reply->content = $request->content;
        $reply->save();
        return $this->responseWithStatus(
            true,
            'Your reply has been updated',
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *  
     * @param App\Http\Controllers\Discussion  $discussion
     * @param App\Http\Controllers\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion, Reply $reply) {
        $reply->delete();
        return $this->responseWithStatus(
            true,
            'Your reply has been deleted',
            JsonResponse::HTTP_OK
            // JsonResponse::HTTP_NO_CONTENT
        );
    }

    private function responseWithStatus($status, $message, $code) {
        return response()->json([
            'success'   => $status,
            'message'   => $message,
        ], $code);
    }
}
