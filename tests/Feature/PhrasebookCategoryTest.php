<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\PhrasebookCategory as Category;
use Illuminate\Http\JsonResponse as Response;
use App\Models\User;
use Tests\TestCase;

class PhrasebookCategoryTest extends TestCase {
    use RefreshDatabase, WithFaker;
    
    /** 
     * Guest can see all phrasebook category
     */
    public function testGuestCanSeeAllPhrasebookCategory() {
        $phrases = Category::factory()->count(5)->create();
        $response = $this->getJson(
            route('phrasebook.category.index')
        );
        $response->assertStatus(Response::HTTP_OK);
        $this->assertNotNull($response['data']);
    }

    /** 
     * Test post phasebook category
     */
    public function testPostCategoryPhrasebook() {
        $this->sanctumAuth();
        $response = $this->postJson(
            route('phrasebook.category.store'),
            $this->arrayCategoryPhrasebook()
        );
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['success']);
    }

    /**
     * Guest can not post phrasebook category
     */
    public function testGuestCanNotPostPhrasebookCategory() {
        $response = $this->postJson(
            route('phrasebook.category.store'),
            $this->arrayCategoryPhrasebook()
        );
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** 
     * Generate automatically category slug
     */
    public function testCategorySlugWillBeCreatedAutomatically() {
        $this->sanctumAuth();
        $title = $this->faker->sentence(3);
        $response = $this->postCategory($title);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['success']);
    }

    /** 
     * Category title must be unique
     */
    public function testCategoryTitleMushBeUnique() {
        $this->sanctumAuth();
        $title = 'Lorem Ipsum';
        $response = $this->postCategory($title);
        // re-post category with the same title
        $response = $this->postCategory($title);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'success' => false,
                'message' => [
                    'title' => ['The title has already been taken.']
                ],
            ]);
        
    }
    
    protected function postCategory($title) {
        return $this->postJson(
            route('phrasebook.category.store'),
            ['title' => $title]
        );
    }

    protected function arrayCategoryPhrasebook() {
        $category = Category::factory()->make();
        return $category->toArray();
    }
}
