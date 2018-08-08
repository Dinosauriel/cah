<?php

use Illuminate\Database\Seeder;

class cards_white_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards_white')->insert([
            'text' => 'A',
            'cardset_id' => 0,
        ]);
    }
}
