<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@simtaka.id',
                'role' => 'ADMIN',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@simtaka.id',
                'role' => 'OPERATOR',
                'password' => Hash::make('password')
            ],
        ]);
    }
}
