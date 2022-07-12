<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            "name" =>  "Arisha  Barron",
            'email' => 'Arisha@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            "name" =>  "Branden  Gibson",
            'email' => 'Branden@gmail.com',
            'password' => Hash::make('123457'),
        ]);
        DB::table('users')->insert([
            "name" =>  "Rhonda  Church",
            'email' => 'Rhonda@gmail.com',
            'password' => Hash::make('123458'),
        ]);
        DB::table('users')->insert([
            "name" =>  "Georgina  Hazel",
            'email' => 'Georgina@gmail.com',
            'password' => Hash::make('123459'),
        ]);
        DB::table('users')->insert([
            "name" =>  "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
            'status' => 1,
        ]);
    }
}
