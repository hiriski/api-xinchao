<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            '1' => '#ff4564',
            '2' => '#6e00ff',
            '3' => '#00b15e',
            '4' => '#ffcd00',
            '5' => '#707070',
            '6' => '#518ef8',
            '7' => '#28b446',
            '8' => '#ffa700',
        ];

        foreach ($colors as $id => $value) {
            Color::create([
                'id'    => (int) $id,
                'value'  => $value,
            ]);
        }
    }
}
