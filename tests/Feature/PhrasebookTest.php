<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\PhrasebookCategory as Category;
use App\Models\Phrasebook;
use App\Models\User;
use Tests\TestCase;

class PhrasebookTest extends TestCase {
    use RefreshDatabase, WithFaker;

    /** 
     * Guest can see phrase list
     */
    public function testGuestCanSeePhraseList() {
        $count = 10;
        $phrases = Phrasebook::factory()
            ->count($count)->create();
        $response = $this->getJson(route('phrasebook.index'));
        $this->assertNotNull($response['data']);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'meta' => [
                    'total' => $count
                ]
            ]);
    }

    /** Client can only fetch twenty phrase at 1 request */
    public function testClientCanFetchOnlyTwentyPhraseAtOne() {
        $itemCount = 30;
        $exceptedCount = 20;
        $phrases = Phrasebook::factory()->count($exceptedCount)->create();
        $response = $this->getJson(
            route("phrasebook.index")
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
     * Test post phase
     */
    public function testPostPhrase() {
        $this->sanctumAuth();
        $response = $this->postJson(
            route('phrasebook.store'),
            $this->arrayPhrasebook()
        );
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['success']);
    }


    /**
     * Guest can not post phrase
     */
    public function testGuestCanNotPostPhraseAndWillBeReturnUnauthorized() {
        $response = $this->postJson(
            route('phrasebook.store'),
            $this->arrayPhrasebook()
        );
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }


    protected function arrayPhrasebook() {
        $phrase = Phrasebook::factory()->make();
        return $phrase->toArray();
    } 

}
