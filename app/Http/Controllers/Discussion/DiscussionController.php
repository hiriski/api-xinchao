<?php

namespace App\Http\Controllers\Discussion;

use Auth;
use App\Models\Discussion;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discussion\UpdateDiscussion as UpdateDiscussionRequest;
use App\Http\Requests\Discussion\StoreDiscussion as DiscussionRequest;
use App\Http\Resources\Discussion\Discussion as DiscussionResource;
use App\Http\Resources\Discussion\DiscussionCollection;

class DiscussionController extends Controller {

    public function __construct() {
        $this->middleware('auth:sanctum')->except([
            'index', 'show'
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // return Discussion::orderBy('id', 'DESC')->paginate(16);
        return new DiscussionCollection(
            Discussion::orderBy('id', 'DESC')->paginate(16)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreDiscussion  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussionRequest $request) {
        $thread = $request->merge([
            'user_id' => Auth::user()->id
        ])->only(['title', 'description', 'content', 'user_id', 'topic_id']);

        Discussion::create($thread);
        return $this->responseWithStatus(
            true,
            'Your Thread has been created.',
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $thread = Discussion::findOrFail($id);
        return new DiscussionResource($thread);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateDiscussion  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscussionRequest $request, $id) {
        $requestThread = $request->only([
            'title', 'description', 'content', 'topic_id'
        ]);
        Discussion::findOrFail($id)->update($requestThread);
        return $this->responseWithStatus(
            true,
            'Thread has been updated.',
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $thread = Discussion::findOrFail($id);
        $thread->delete();
        return $this->responseWithStatus(
            true,
            'Thread has been delete.',
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
