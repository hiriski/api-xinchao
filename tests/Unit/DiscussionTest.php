<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Discussion;
use App\Models\Topic;
use App\Models\User;
use Tests\TestCase;

class DiscussionTest extends TestCase {
    use RefreshDatabase;

    /**
     * Relation Discussion between User
     */
    public function testDiscussionBelongsToUser() {
        $user = User::factory()->create();
        $thread = Discussion::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->assertEquals($user->id, $thread->user->id);
    }

    /**
     * Relation Discussion between Topic
     */
    public function testDiscussionBelongsToTopic() {
        $topic = Topic::factory()->create();
        $thread = Discussion::factory()->create([
            'topic_id' => $topic->id,
        ]);
        $this->assertEquals($topic->id, $thread->topic->id);
    }
}
