<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FillWithData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill {--file=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if( $this->option('file') == 'all' ){
            return ;
        }else{
            if( file_exists(base_path('/storage/data/' . $this->option('file'))) ){
                return;
            }
        }
    }
}
