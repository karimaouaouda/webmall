<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDemoReady extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-demo {--random}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if( $this->hasOption('random') ){
            /**
             * fill the database with random information
             */

            $this->output->info('handle data creation with random data');
        }else{

            /**
             * fill the database with real information from files
             */
            $this->output->info('handle data creation from files');

        }
    }
}
