<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemkratonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemkratons')->insert([
            [
                'nama' => 'Kawedanan Hageng Punokawan Datu Dana Suyasa',
            ],
            [
                'nama' => 'Kawedanan Panitikismo',
            ],
            [
                'nama' => 'Kawedanan Rekso Suyoso',
            ],
            [
                'nama' => 'Kawedanan Sasana Puro',
            ],
        ]);
    }
}
