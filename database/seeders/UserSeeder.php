<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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
                'email'     => 'hi@riski.me',
                'password'  => Hash::make('secret'),
                'level_id'  => 1,
                'status_id' => 1,
                'created_at'=> Carbon::now(),
            ),
            array(
                'id'        => 2,
                'name'      => 'Admin',
                'username'  => Str::slug('Admin'),
                'email'     => 'xinchaodev@gmail.com',
                'password'  => Hash::make('secret'),
                'level_id'  => 1,
                'status_id' => 1,
                'created_at'=> Carbon::now(),
            )
        );
        DB::table($this->tableName)->insert($defaultUsers);
    }
}
