<?php

use Illuminate\Database\Seeder;

class cards_black_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards_black')->insert([
            'number_to_draw' => 3,
            'number_to_play' => 2,
            'text' => 'this {{}} is {{}} a {{}} test',
            'cardset_id' => 0,
        ]);
    }
}
