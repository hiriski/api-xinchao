<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserStatus;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            '1' => 'Aktif',
            '2' => 'Inactive',
        ];

        foreach ($levels as $id => $title) {
            UserStatus::create([
                'id'    => (int) $id,
                'name'  => $title, 
            ]);
        }
    }
}
