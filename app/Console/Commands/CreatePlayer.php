<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Player;

class CreatePlayer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
	protected $signature = 'player:create
		{--t|temporary : create a temporary user}
		{--a|admin : create an administrator}
		{--u|username= : (required) the username}
		{--p|password= : the password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a new user and add it to the database';

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
		$options = $this->options();

        if (empty($options['username'])) {
			$this->line('please provide a username (option -u)');
			return;
		}

		if (!empty(Player::username($options['username'])->first())) {
			$this->line('username already taken');
			return;
		}

		$player = new Player;
		$player->username = $options['username'];
		$player->is_temporary = $options['temporary'];
		$player->is_admin = $options['admin'];

		if (!empty($options['password'])) {
			$player->password = bcrypt($options['password']);
		}

		$player->save();
		$this->line('player successfully created');
    }
}
