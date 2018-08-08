<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            'username' => 'player1'
        ]);
        DB::table('players')->insert([
            'username' => 'player2'
        ]);
        DB::table('players')->insert([
            'username' => 'player3'
        ]);
        
        $this->call([
            cards_black_seeder::class,
            cards_white_seeder::class,
        ]);
    }
}
