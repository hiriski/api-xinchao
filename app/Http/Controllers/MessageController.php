<?php

namespace App\Http\Controllers;

use App\Http\Resources\Conversation as ConversationResource;
use App\Http\Resources\Message as MessageResource;
use App\Http\Resources\MessageCollection;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mockery\Exception;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return MessageCollection
     */
    public function index()
    {
    }

    /**
     * Send first message.
     * @param Request $request
     * @param $toUserId
     * @return ConversationResource|\Illuminate\Http\JsonResponse
     */
    public function firstMessage(Request $request, $toUserId) {
        $requestData    = $request->only(['text']);
        $authUserId     = auth()->id();
        try {
            $toUserId       = User::findOrFail($toUserId)->id;
            $conversation   = Conversation::create([
                'conversation_type' => 'private', // default is private chat.
                'channel_id'        => Str::random(3) . '_' . time(),
            ]);
            $conversation->participants()->sync([$toUserId, $authUserId]);
            $message = $conversation->messages()->create([
                'sender_id' => $authUserId,
                'text'      => $request->text,
            ]);
            return new ConversationResource($conversation);
        } catch (Exception $e) {
            return response()->json([
                'message'   => $e->getMessage()
            ]);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @param $conversationId
     * @return MessageCollection
     */
    public function fetch($conversationId)
    {
        $messages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'desc')->get();
        return new MessageCollection($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $conversationId
     * @return MessageResource
     */
    public function send(Request $request, $conversationId)
    {
        $data = $request->only(['sender_id', 'text', 'conversation_id']);
        $data['sender_id'] = auth()->id();
        $data['conversation_id'] = $conversationId;
        $message = Message::create($data);
        return new MessageResource($message);
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
