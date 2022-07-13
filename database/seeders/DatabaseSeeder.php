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
            "address" =>  "khoye behesht",
            "city" =>  "khoy",
            "phone" =>  "09143612440",
            "birthday" =>  "13526425",
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            "name" =>  "Branden  Gibson",
            'email' => 'Branden@gmail.com',
            "address" =>  "khoye behesht",
            "city" =>  "khoy",
            "phone" =>  "09143612440",
            "birthday" =>  "13526425",
            'password' => Hash::make('123457'),
        ]);
        DB::table('users')->insert([
            "name" =>  "Rhonda  Church",
            'email' => 'Rhonda@gmail.com',
            "address" =>  "khoye behesht",
            "phone" =>  "09143612440",
            "city" =>  "khoy",
            "birthday" =>  "13526425",
            'password' => Hash::make('123458'),
        ]);
        DB::table('users')->insert([
            "name" =>  "Georgina  Hazel",
            'email' => 'Georgina@gmail.com',
            "address" =>  "khoye behesht",
            "phone" =>  "09143612440",
            "city" =>  "khoy",
            "birthday" =>  "13526425",
            'password' => Hash::make('123459'),
        ]);
        DB::table('users')->insert([
            "name" =>  "admin",
            'email' => 'admin@gmail.com',
            "address" =>  "khoye behesht",
            "phone" =>  "09143612440",
            "city" =>  "khoy",
            "birthday" =>  "13526425",
            'password' => Hash::make('123123'),
            'status' => 1,
        ]);

        DB::table('banks')->insert([
            "name" =>  "visa",
            "branch" =>  "visa",
            'pin_code' => 'sad56sad',
            'phone_no' => '0321318564',
        ]);
        DB::table('accounts')->insert([
            "account_no" =>  "432464263544",
            'account_type' => 'type 1',
            'status' => 1,
            'total_balance' => 5000,
            'total_limited' => 10000,
            'bank_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('accounts')->insert([
            "account_no" =>  "903240202340",
            'account_type' => 'type 1',
            'status' => 1,
            'total_balance' => 1000000,
            'total_limited' => 2000,
            'bank_id' => 1,
            'user_id' => 2,
        ]);

    }
}
