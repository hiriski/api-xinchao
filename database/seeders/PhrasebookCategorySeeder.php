<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhrasebookCategorySeeder extends Seeder {

    /**
     * Table name
     * @var string
     */
    protected $tableName = 'phrasebook_categories';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table($this->tableName)->delete();
        $categories = array(
            array('id' => 1,    'name' => 'Uncategory'),
            array('id' => 2,    'name' => 'Umum'),
            array('id' => 3,    'name' => 'Salam'),
            array('id' => 4,    'name' => 'Asmara'),
            array('id' => 5,    'name' => 'Darurat'),
            array('id' => 6,    'name' => 'Makan'),
            array('id' => 7,    'name' => 'Belanja'),
            array('id' => 8,    'name' => 'Angka'),
            array('id' => 9,    'name' => 'Transportasi'),
            array('id' => 10,   'name' => 'Akomodasi'),
            array('id' => 11,   'name' => 'Petunjuk Arah'),
            array('id' => 12,   'name' => 'Cuaca'),
            array('id' => 13,   'name' => 'Berkendara'),
            array('id' => 14,   'name' => 'Tempat'),
            array('id' => 15,   'name' => 'Tamasya'),
            array('id' => 16,   'name' => 'Hewan'),
            array('id' => 17,   'name' => 'Tanggal/Waktu'),
            array('id' => 18,   'name' => 'Warna'),
            array('id' => 19,   'name' => 'Pelajaran'),
            array('id' => 20,   'name' => 'Pekerjaan'),
            array('id' => 21,   'name' => 'Buah-buahan'),
            array('id' => 22,   'name' => 'Hobi'),
            array('id' => 23,   'name' => 'Kesehatan'),
            array('id' => 24,   'name' => 'Lain-lain'),
        );
        DB::table($this->tableName)->insert($categories);
    }
}
