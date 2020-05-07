<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use \RecursiveDirectoryIterator;
use \RecursiveIteratorIterator;

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

    public function dirToArray($dir)
    {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                $fullname = $dir . DIRECTORY_SEPARATOR . $value;
                if (is_dir($fullname)) {
                    $result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle($folder = "vendor")
    {
        $vendorPath = public_path($folder);

        $dir_iterator = new RecursiveDirectoryIterator($vendorPath);
        $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::SELF_FIRST);
        // could use CHILD_FIRST if you so wish
        $exclude = ["node_modules"];
        foreach ($iterator as $file) {
            $fileName = basename($file);
            preg_match("/(^node_modules)/", $file, $matches, PREG_OFFSET_CAPTURE);
            print_r($matches);
        }



        // $FilesList = $this->dirToArray($vendorPath);

        // $cssFiles = array_column($FilesList, 'dist');
        // $jsFiles = array_column($FilesList, 'js');
        // print_r($cssFiles);


    }
}
