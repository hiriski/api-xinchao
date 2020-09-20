<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\PhrasebookCategory as Category;
use App\Models\Phrasebook;
use Tests\TestCase;

class PhrasebookCategoryTest extends TestCase {
    use RefreshDatabase;

    /**
     * Relation PhrasebookCategory between Phrasebook
     */
    public function testPhrasebookCategoryHasManyPhrases() {
        $count = 5;
        $category = Category::factory()->create();
        $phrasebook = Phrasebook::factory()->count($count)->create([
            'category_id' => $category->id,
        ]);
        $this->assertCount($count, $category->phrases);
    }
}
