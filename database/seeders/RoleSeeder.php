<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{

    protected $tableName = "roles";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->tableName)->delete();

        $roles = [
            [
                'id'            => 1,
                'en_US'         => 'New Member',
                'slug'          => Str::slug('New Member'),
                'description'   => null
            ],
            [
                'id'            => 2,
                'en_US'         => 'Member',
                'slug'          => Str::slug('Member'),
                'description'   => null
            ],
            [
                'id'            => 3,
                'en_US'         => 'Contributor',
                'slug'          => Str::slug('Contributor'),
                'description'   => null
            ],
            [
                'id'            => 4,
                'en_US'         => 'Admin',
                'slug'          => Str::slug('Admin'),
                'description'   => null
            ],
            [
                'id'            => 5,
                'en_US'         => 'Developer',
                'slug'          => Str::slug('Developer'),
                'description'   => null
            ],
        ];
        DB::table($this->tableName)->insert($roles);
    }
}
