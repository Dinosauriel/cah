<?php

namespace App\Console\Commands;

use App\Cardset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;

class UpdateCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'read "resources/cards/" and add all new cardsets, remove deleted/disabled cardsets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //delete all old items
        Schema::disableForeignKeyConstraints();

        DB::table('cards_white')->truncate();
        DB::table('cards_black')->truncate();
        DB::table('cardsets')->truncate();

        Schema::enableForeignKeyConstraints();

        //add new items
        $sourceDirectory = 'resources/cards/';
        $files = glob($sourceDirectory . '*.json');

        //\Illuminate\Support\Facades\Log::debug($files);
        foreach ($files as $file) {
            $json = file_get_contents($file);
            $cards = json_decode($json, true);

            foreach ($cards['cardsets'] as $cs) {

                if (!$cs['enabled']) {
                    continue;
                }

                $cardsetContent = [
                    'name' => $cs['name'],
                    'acronym' => $cs['acronym'],
                    'language' => $cs['language']
                ];

                if (!empty($cs['color'])) {
                    $cardsetContent['color'] = $cs['color'];
                }

                $databaseSet = new Cardset($cardsetContent);

                $databaseSet->save();

                //\Illuminate\Support\Facades\Log::debug($databaseSet);
                
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
