<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PublicFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Public:Files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get All Public files';

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
        $FilesList = [];
        foreach(glob(public_path("vendor") . "\*") as $files) {
            $FilesList[] = $files;
        }

        print_r($FilesList);
    }
}
