<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhrasebookSeeder extends Seeder {

    /**
     * Table name
     * @var string
     */
    protected $tableName = 'phrasebooks';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $dummyPhrases = array(
            array(
                'created_by'    => 1,
                'category_id'   => 3,
                'id_ID'         => 'Halo 👋',
                'vi_VN'         => 'Xin chào 👋',
                'en_US'         => 'Hello 👋',
                'notes'         => '<strong>Xin chao</strong> atau <strong>Chào anh(L)</strong>, <strong>Chào chị(P)</strong> memiliki arti yang sama. Terkadang native speaker hanya mengatakan <strong>Chào</strong>',
            ),
            array(
                'created_by'    => 1,
                'category_id'   => 3,
                'id_ID'         => 'Siap nama Anda?',
                'vi_VN'         => 'Bạn tên gì?',
                'en_US'         => 'What\'s your name?',
                'notes'         => null,
            ),
            array(
                'created_by'    => 1,
                'category_id'   => 3,
                'id_ID'         => 'Nama saya Riski',
                'vi_VN'         => 'Tôi tên là Riski',
                'en_US'         => 'My name is Riski',
                'notes'         => null
            ),
            array(
                'created_by'    => 1,
                'category_id'   => 4,
                'id_ID'         => 'Aku cinta kamu',
                'vi_VN'         => 'An yêu em/Em yêu anh',
                'en_US'         => 'I love you',
                'notes'         => '<strong>Anh yêu em</strong> dikatakan oleh Pria, <strong>Em yêu anh</strong> untuk Wanita'
            ),
        );
        DB::table($this->tableName)->insert($dummyPhrases);
    }
}
