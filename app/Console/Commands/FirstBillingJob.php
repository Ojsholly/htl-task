<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Traits\BillingTrait;
use Illuminate\Console\Command;

class FirstBillingJob extends Command
{
    use BillingTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'first:billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bill the first set of 2,000 users';

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
        User::where('id', '<=', '2000')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $this->bill_user($user->id);
            }
        });
    }
}