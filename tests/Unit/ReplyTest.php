<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Discussion;
use App\Models\Reply;
use App\Models\User;
use Tests\TestCase;

class ReplyTest extends TestCase {
    use RefreshDatabase;

    /**
     * Relation between Reply and Discussion
     */
    public function testReplyBelongsToDiscussion() {
        $thread = $this->thread();
        $reply = Reply::factory()->create([
            'discussion_id' => $thread->id,
        ]);
        $this->assertEquals($thread->id, $reply->discussion->id);
    }
    
    /**
     * Relation between Reply and User
     */
    public function testReplyBelongsToUser() {
        $thread = $this->thread();
        $user = User::factory()->create();
        $reply = Reply::factory()->create([
            'discussion_id' => $thread->id,
            'user_id'  => $user->id
        ]);
        $this->assertEquals($user->id, $reply->user->id);
    }


    protected function thread() {
        return Discussion::factory()->create();
    }
}
