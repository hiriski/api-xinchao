<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Phrasebook;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase {
    use RefreshDatabase;

    /**
     * Relation User between Phrasebook
     */
    public function testUserHasManyPhrases() {
        $count = 5;
        $user = User::factory()->create();
        $phrasebook = Phrasebook::factory()->count($count)->create([
            'created_by' => $user->id,
        ]);
        $this->assertCount($count, $user->phrases);
    }
}
