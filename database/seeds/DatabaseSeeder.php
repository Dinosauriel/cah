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
            'username' => 'player1',
            'password' => bcrypt('my-secret-password'),
            'is_admin' => 1,
            'is_temporary' => 1,
            'api_token' => 'p1'
        ]);
        DB::table('players')->insert([
			'username' => 'player2',
            'is_temporary' => 1,
            'api_token' => 'p2'
        ]);
        DB::table('players')->insert([
			'username' => 'player3',
            'is_temporary' => 1,
            'api_token' => 'p3'
        ]);

        DB::table('cardsets')->insert([
            'name' => 'test-cards'
        ]);

        DB::table('games')->insert([
            'public_id' => 'gameA',
            'status' => 'draft',
            'name' => 'Test-Game',
            'owner_id' => 1
        ]);

        DB::table('games')->insert([
            'public_id' => 'gameB',
            'status' => 'ingame',
            'name' => 'Test-In-Game',
            'owner_id' => 2
        ]);
        
        $this->call([
            cards_black_seeder::class,
            cards_white_seeder::class,
            CardsSeeder::class
        ]);

        DB::table('game_player')->insert([
            'game_id' => 1,
            'player_id' => 1
        ]);
    }
}
