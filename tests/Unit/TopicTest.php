<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Discussion;
use App\Models\Topic;
use Tests\TestCase;

class TopicTest extends TestCase {
    use RefreshDatabase;
    
    /**
     * Relation Topic between Discussion
     */
    public function testTopicHasManyDiscussions() {
        $count = 5;
        $topic = Topic::factory()->create();
        $thread = Discussion::factory()->count($count)->create([
            'topic_id' => $topic->id,
        ]);
        $this->assertCount($count, $topic->discussions);
    }
}
