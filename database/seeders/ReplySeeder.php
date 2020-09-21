<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Reply::factory()
            ->times(3)
            ->forUser([
                'name'  => 'Nguyen Thuy'
            ])
            ->create();
    }
}
