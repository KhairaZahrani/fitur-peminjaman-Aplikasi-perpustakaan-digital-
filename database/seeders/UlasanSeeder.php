<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ulasan')->insert([
            'id_buku' => 1,
            'id_user' => 1,
            'ulasan' => 'bagus',
            'rating' => 1,
        ]);
    }
}
