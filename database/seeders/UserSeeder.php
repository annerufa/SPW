<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'admin',
            'alamat' => 'admin',
            'email' => 'admin@gmail.com',
            'noHp' => '1234567890',
            'username' => 'admin',
            'password' => 'admin',
            'jabatan' => 'admin',
        ]);

        DB::table('users')->insert([
            'nama' => 'John Doe',
            'alamat' => 'John Doe',
            'email' => 'doe@gmail.com',
            'noHp' => '1234567890',
            'username' => 'owner',
            'password' => '12345',
            'jabatan' => 'owner',
        ]);

        DB::table('users')->insert([
            'nama' => 'John Doe',
            'alamat' => 'John Doe',
            'email' => 'john@gmail.com',
            'noHp' => '1234567890',
            'username' => 'peg1',
            'password' => '12345',
            'jabatan' => 'pegawai',
        ]);
    }
}
