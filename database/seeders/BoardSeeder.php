<?php

namespace Database\Seeders;

use App\Models\Board\Board;
use App\Models\Board\Users_board;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_boards')->delete();
        DB::table('boards')->delete();
        Board::factory()
        ->count(40)
        ->hasUser(10)
        ->create();

        Users_board::factory()
        ->count(10)
        ->create();
    }
}
