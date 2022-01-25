<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'user001',
            'email_verified_at' => now(),
            'email' => 'user001@gmail.com',
            'password' => Hash::make('user001'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'user002',
            'email_verified_at' => now(),
            'email' => 'user002@gmail.com',
            'password' => Hash::make('user002'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'user003',
            'email_verified_at' => now(),
            'email' => 'user003@gmail.com',
            'password' => Hash::make('user003'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'user004',
            'email_verified_at' => now(),
            'email' => 'user004@gmail.com',
            'password' => Hash::make('user004'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'user005',
            'email_verified_at' => now(),
            'email' => 'user005@gmail.com',
            'password' => Hash::make('user005'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->count(100)->create();
    }
}
