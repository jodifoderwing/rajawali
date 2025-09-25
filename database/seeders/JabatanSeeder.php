<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            [
                'nama' => 'Penghageng',
            ],
            [
                'nama' => 'Wakil Penghageng',
            ],
            [
                'nama' => 'Penghageng II',
            ],
            [
                'nama' => 'Carik I',
            ],
            [
                'nama' => 'Carik II',
            ],
            [
                'nama' => 'Kahartakan I',
            ],
            [
                'nama' => 'Kahartakan II',
            ],
            [
                'nama' => 'Tenaga Ahli',
            ],
            [
                'nama' => 'Tenaga Administrasi',
            ],
            [
                'nama' => 'Tenaga Lapangan',
            ],
            [
                'nama' => 'Tenaga Bantu',
            ],
        ]);
    }
}
