<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse as Response;
use App\Models\Discussion;
use App\Models\Topic;
use App\Models\User;
use Tests\TestCase;

class DiscussionTest extends TestCase {
    use RefreshDatabase;

    /** 
     * Guest can see discussion threads
     */
    public function testAGuestCanSeeThreads() {
        $count = 10;
        $thread = Discussion::factory()
            ->count($count)->create();
        $response = $this->getJson(route('discussion.index'));
        $this->assertNotNull($response['data']);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'meta' => [
                    'total' => $count
                ]
            ]);
    }

    /** Client can only fetch sixteen thread at 1 request */
    public function testAClientCanFetchOnlySixteenThreadAtOne() {
        $itemCount = 20;
        $exceptedCount = 16;
        $threads = Discussion::factory()->count($itemCount)->create();
        $response = $this->getJson(
            route("discussion.index")
        );
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'meta' => [
                    'per_page' => $exceptedCount,
                ]
            ]);
    }

    /** 
     * Test post thread
     */
    public function testPostAThread() {
        $this->sanctumAuth();
        $response = $this->postJson(
            route('discussion.store'),
            $this->arrayThread()
        );
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['success']);
    }


    /**
     * A Discussion thread has a creator
     */
    public function testAThreadHasACreator() {
        $this->sanctumAuth();
        $user = User::factory()->create();
        $thread = Discussion::factory()->create([
            'user_id' => $user->id
        ]);
        $this->assertEquals($user->id, $thread->user->id);
    }


    /**
     * Guest can not post thread
     */
    public function testUnauthenticatedUsersCanNotPostAThread() {
        $response = $this->postJson(
            route('discussion.store'),
            $this->arrayThread()
        );
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    
    /**
     * Title and content is required
     */
    public function testAThreadRequiresTitle() {
        $this->sanctumAuth();
        $thread = Discussion::factory()->make([
            'title' => ''
        ]);
        $response = $this->postJson(
            route('discussion.store'),
            $thread->toArray()
        );
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => [
                    'title' => ['The title field is required.']
                ],
            ]);
    }

    protected function arrayThread() {
        $thread = Discussion::factory()->make();
        return $thread->toArray();
    } 
}
