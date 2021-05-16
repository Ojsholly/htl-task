<?php

namespace App\Console\Commands;

use App\Traits\BillingTrait;
use App\Models\User;
use Illuminate\Console\Command;

class SecondBillingJob extends Command
{
    use BillingTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'second:billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bill the second set 2,000 users';

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
        // Bill the second set of users.
        User::where('id', '>=', '2001')->where('id', '<=', '4000')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $this->bill_user($user->id);
            }
        });
    }
}