<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Traits\BillingTrait;
use Illuminate\Console\Command;

class FifthBillingJob extends Command
{
    use BillingTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fifth:billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bill the fifth set of 2,000 users';

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
        // Bill the fifth set of users.
        User::where('id', '>=', '8001')->where('id', '<=', '10000')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $this->bill_user($user->id);
            }
        })->whereBetween('id', [8001, 10000]);
    }
}