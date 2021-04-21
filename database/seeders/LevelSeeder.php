<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            '1' => 'Level 1',
            '2' => 'Level 2',
            '3' => 'Level 3',
            '4' => 'Level 4',
            '5' => 'Level 5',
        ];

        foreach ($levels as $id => $title) {
            Level::create([
                'id'    => (int) $id,
                'name'  => $title, 
                'description'  => null
            ]);
        }
    }
}
