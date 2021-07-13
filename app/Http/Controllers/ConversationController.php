<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Conversation as ConversationResource;
use App\Http\Resources\ConversationCollection;
use App\Models\Conversation;
use Illuminate\Support\Str;

class ConversationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return ConversationCollection
     */
    public function index()
    {
        $conversations = auth()->user()->conversations()->get();
        return new ConversationCollection($conversations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = $request->conversation_type;
        $participants = $request->participants;
        $conversation = Conversation::create([
            'conversation_type' => $type !== null ? $type : 'private',
            'channel_id'        => Str::random(3) . '_' . time(),
        ]);
        $conversation->participants()->attach($participants);
        return new ConversationResource($conversation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
