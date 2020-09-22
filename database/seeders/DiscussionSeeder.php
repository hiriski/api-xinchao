<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discussion;

class DiscussionSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Discussion::factory()
            ->times(3)
            ->forUser([
                'name' => 'Riski Dep Trai'
            ])
            ->create();
    }
}
