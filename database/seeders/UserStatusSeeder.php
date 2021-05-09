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
            '1' => 'Active',
            '2' => 'Inactive',
        ];

        foreach ($levels as $id => $name) {
            UserStatus::create([
                'id'    => (int) $id,
                'name'  => $name,
            ]);
        }
    }
}
