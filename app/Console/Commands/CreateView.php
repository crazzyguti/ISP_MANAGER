<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class CreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudView';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Crud View';

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
        $columns = ['FirstName', 'LastName'];

        $users = User::all(['firstName', 'lastName'])->toArray();

        $this->table($columns, $users);
    }
}
