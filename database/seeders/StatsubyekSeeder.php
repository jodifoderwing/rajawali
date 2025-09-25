<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatsubyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statsubyeks')->insert([
            [
                // 'id'            => 1,
                'nama'          => 'Perorangan',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                // 'id'            => 2,
                'nama'          => 'Instansi Pemerintah',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                // 'id'            => 3,
                'nama'          => 'Badan Hukum',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                // 'id'            => 4,
                'nama'          => 'Organisasi/Lembaga',
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);
    }
}
