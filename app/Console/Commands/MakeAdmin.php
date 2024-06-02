<?php

namespace App\Console\Commands;

use App\Models\Auth\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

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
        (new Admin([
            'name' => 'Karim Aouaouda',
            'email' => 'karimaouaouda.officiel@gmail.com',
            'password' => Hash::make('cpplang24')
        ]))->save();
    }
}
