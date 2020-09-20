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
            array('id' => 1,    'title' => 'Uncategory',     'slug' => Str::slug('Uncategory')),
            array('id' => 2,    'title' => 'Umum',           'slug' => Str::slug('Umum')),
            array('id' => 3,    'title' => 'Salam',          'slug' => Str::slug('Salam')),
            array('id' => 4,    'title' => 'Asmara',         'slug' => Str::slug('Asmara')),
            array('id' => 5,    'title' => 'Darurat',        'slug' => Str::slug('Darurat')),
            array('id' => 6,    'title' => 'Makan',          'slug' => Str::slug('Makan')),
            array('id' => 7,    'title' => 'Belanja',        'slug' => Str::slug('Belanja')),
            array('id' => 8,    'title' => 'Angka',          'slug' => Str::slug('Angka')),
            array('id' => 9,    'title' => 'Transportasi',   'slug' => Str::slug('Transportasi')),
            array('id' => 10,   'title' => 'Akomodasi',      'slug' => Str::slug('Akomodasi')),
            array('id' => 11,   'title' => 'Petunjuk Arah',  'slug' => Str::slug('Petunjuk Arah')),
            array('id' => 12,   'title' => 'Cuaca',          'slug' => Str::slug('Cuaca')),
            array('id' => 13,   'title' => 'Berkendara',     'slug' => Str::slug('Berkendara')),
            array('id' => 14,   'title' => 'Tempat',         'slug' => Str::slug('Tempat')),
            array('id' => 15,   'title' => 'Tamasya',        'slug' => Str::slug('Tamasya')),
            array('id' => 16,   'title' => 'Hewan',          'slug' => Str::slug('Hewan')),
            array('id' => 17,   'title' => 'Tanggal/Waktu',  'slug' => Str::slug('Tanggal Waktu')),
            array('id' => 18,   'title' => 'Warna',          'slug' => Str::slug('Warna')),
            array('id' => 19,   'title' => 'Pelajaran',      'slug' => Str::slug('Pelajaran')),
            array('id' => 20,   'title' => 'Pekerjaan',      'slug' => Str::slug('Pekerjaan')),
            array('id' => 21,   'title' => 'Buah-buahan',    'slug' => Str::slug('Buah-buahan')),
            array('id' => 22,   'title' => 'Hobi',           'slug' => Str::slug('Hobi')),
            array('id' => 23,   'title' => 'Kesehatan',      'slug' => Str::slug('Kesehatan')),
            array('id' => 24,   'title' => 'Lain-lain',      'slug' => Str::slug('Lain-lain'))
        );
        DB::table($this->tableName)->insert($categories);
    }
}
