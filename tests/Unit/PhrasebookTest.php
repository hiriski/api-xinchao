<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\PhrasebookCategory as Category;
use App\Models\Phrasebook;
use App\Models\User;
use Tests\TestCase;

class PhrasebookTest extends TestCase {
    
    use RefreshDatabase;

    /**
     * Relation Phrasebook between User
     */
    public function testPhrasebookBelongsToUser() {
        $user = User::factory()->create();
        $phrasebook = Phrasebook::factory()->create([
            'created_by' => $user->id,
        ]);
        $this->assertEquals($user->id, $phrasebook->creator->id);
    }

    /**
     * Relation Phrasebook between PhrasebookCategory
     */
    public function testPhrasebookBelongsToPhrasebookCategory() {
        $category = Category::factory()->create();
        $phrasebook = Phrasebook::factory()->create([
            'category_id' => $category->id,
        ]);
        $this->assertEquals($category->id, $phrasebook->category->id);
    }
}
