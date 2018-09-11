<?php

use App\Cardset;
use Illuminate\Database\Seeder;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sourceDirectory = 'resources/cards/';
        $files = glob($sourceDirectory . '*.json');

        //\Illuminate\Support\Facades\Log::debug($files);
        foreach ($files as $file) {
            $json = file_get_contents($file);
            $cards = json_decode($json, true);

            foreach ($cards['cardsets'] as $cs) {

                $databaseSet = new Cardset([
                    'name' => $cs['name'],
                    'acronym' => $cs['acronym']
                ]);

                $databaseSet->save();

                \Illuminate\Support\Facades\Log::debug($databaseSet);
                
                foreach ($cs['white'] as &$c) {
                    $c['cardset_id'] = $databaseSet->id;
                }

                foreach ($cs['black'] as &$c) {
                    $c['cardset_id'] = $databaseSet->id;
                }

                DB::table('cards_white')->insert($cs['white']);     
                DB::table('cards_black')->insert($cs['black']);
            }
        }
    }
}
