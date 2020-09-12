<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {

    protected $tableName = 'users';
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table($this->tableName)->delete();
        $defaultUsers = array(
            array(
                'id'        => 1,
                'name'      => 'Riski',
                'username'  => Str::slug('Riski'),
                'email'     => 'xinchao@riski.web.id',
                'password'  => Hash::make('secret')
            ),
            array(
                'id'        => 2,
                'name'      => 'Admin',
                'username'  => Str::slug('Admin'),
                'email'     => 'belajarbahasavietnam@gmail.com',
                'password'  => Hash::make('secret')
            )
        );
        DB::table($this->tableName)->insert($defaultUsers);
    }
}
