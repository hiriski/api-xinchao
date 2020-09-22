<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Discussion;
use App\Models\Reply;
use Tests\TestCase;

class ReplyTest extends TestCase {
    use RefreshDatabase, WithFaker;
    
    /** 
     * Guest can see all replies
     */
    public function testAGuestCanSeeAllRepliesDiscussion() {
        $replyCount = 5;
        $thread = $this->thread();
        $replies = Reply::factory()->count($replyCount)->create([
            'discussion_id' => $thread->id,
        ]);
        $response = $this->getJson(
            route('discussion.show', $thread->id)
        );
        $response->assertStatus(Response::HTTP_OK);
        $this->assertCount($replyCount, $response['data']['replies']);
    }

    /** 
     * Test create a new reply
     */
    public function testPostANewReply() {
        $this->sanctumAuth();
        $thread = $this->thread();
        $response = $this->postReply($thread->id, $this->arrayReply());
        $response
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJson([
            'message' => 'You have replied successfully.'
            ]);
        $this->assertTrue($response['success']);
    }

    /**
     * Guest can not reply discussion
     */
    public function testAGuestCanNotPostReplyDiscussion() {
        $thread = $this->thread();
        $response = $this->postReply($thread->id, $this->arrayReply());
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** 
     * A reply requires content
     */
    public function testAReplyRequiresContent() {
        $this->sanctumAuth();
        $thread = $this->thread();
        $response = $this->postReply($thread->id, []);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => [
                    'content' => ['The content field is required.']
                ],
            ]);
        
    }
    
    protected function postReply($thread_id, $arrReply) {
        return $this->postJson(
            route('discussion.reply.store', $thread_id),
            $arrReply,
        );
    }

    protected function arrayReply() {
        $reply = Reply::factory()->make();
        return $reply->toArray();
    }

    protected function thread() {
        return Discussion::factory()->create();
    }
}
