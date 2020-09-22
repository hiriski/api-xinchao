<?php

namespace App\Http\Controllers\Discussion;

use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Discussion\TopicCollection;
use App\Http\Resources\Discussion\Topic as TopicResource;
use App\Http\Requests\Discussion\StoreTopic as TopicRequest;

class TopicController extends Controller {

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
        return new TopicCollection(Topic::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreTopic $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request) {
        $topic = new Topic;
        $topic->title = $request->title;
        $topic->slug = Str::slug($request->title, '-');
        $topic->save(); 

        return $this->responseWithStatus(
            true,
            'Topic created',
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreTopic  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, $slug) {
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $topic->title = $request->title;
        $topic->slug = Str::slug($request->title);
        $topic->save();
        return $this->responseWithStatus(
            true,
            'Topic updated!',
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param String $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug) {
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $topic->delete();
        return $this->responseWithStatus(
            true,
            'Topic deleted',
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
