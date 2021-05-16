<?php

namespace App\Console\Commands;

use App\Traits\BillingTrait;
use App\Models\User;
use Illuminate\Console\Command;

class FourthBillingJob extends Command
{
    use BillingTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fourth:billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bill the fourth set of 2,000 users';

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
     * @return int
     */
    public function handle()
    {
        // Bill the first set of users.
        User::where('id', '>=', '6001')->where('id', '<=', '8000')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $this->bill_user($user->id);
            }
        })->whereBetween('id', [6001, 8000]);
    }
}