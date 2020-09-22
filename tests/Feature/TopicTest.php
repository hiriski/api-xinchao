<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse as Response;
use App\Models\Discussion;
use App\Models\Topic;
use Tests\TestCase;

class TopicTest extends TestCase {
    use RefreshDatabase, WithFaker;
    
    /** 
     * Guest can see all topic discussion
     */
    public function testAGuestCanSeeAllTopicDiscussion() {
        $thread = Discussion::factory()->count(5)->create();
        $response = $this->getJson(route('discussion.topic.index'));
        $response->assertStatus(Response::HTTP_OK);
        $this->assertNotNull($response['data']);
    }

    /** 
     * Test create new topic discussion
     */
    public function testCreateNewTopicDiscussion() {
        $this->sanctumAuth();
        $response = $this->postTopic($this->arrayTopic());
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['success']);
    }

    /**
     * Guest can not create topic discussion
     */
    public function testAGuestCanNotCreateTopicDiscussion() {
        $response = $this->postTopic($this->arrayTopic());
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** 
     * Generate automatically topic slug
     */
    public function testATopicSlugWillBeCreatedAutomatically() {
        $this->sanctumAuth();
        $title = $this->faker->sentence(3);
        $response = $this->postTopic([
            'title' => $title
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['success']);
    }

    /** 
     * Topic title & slug must be unique
     */
    public function testATopicTitleAndSlugMushBeUnique() {
        $this->sanctumAuth();
        $title = $this->faker->sentence(3);
        $response = $this->postTopic([
            'title' => $title
        ]);
        // re-post topic thread with the same title
        $response = $this->postTopic([
            'title' => $title
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => [
                    'title' => ['The title has already been taken.']
                ],
            ]);
        
    }
    
    protected function postTopic($data) {
        return $this->postJson(
            route('discussion.topic.store'),
            $data
        );
    }

    protected function arrayTopic() {
        $topic = Topic::factory()->make();
        return $topic->toArray();
    }
}
