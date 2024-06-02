<?php

namespace App\Console\Commands;

use App\Models\Auth\Seller;
use App\Notifications\TestNotification;
use Illuminate\Console\Command;

class TestEmailSending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-email';

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
        $user = Seller::find(1);

        try{
            $user->notify(new TestNotification());
            $this->output->info("message sent successfully");
        }catch(\Exception $e){
            echo $e->getMessage();
        }

    }
}
