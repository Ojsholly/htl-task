<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Billing Trait
 */
trait BillingTrait
{
    protected function bill_user($user_id)
    {
        $user = User::findOrFail($user_id);

        try {

            //code...
            //Application logic to bill user with external payment gateway of choice.

            $status = "success";        // Assume payment was successful

            $log  = DB::transaction(function () use ($user, $status) {
                if ($status != 'success') {
                    # code...

                    $data = [
                        'user_id' => $user->id,
                        'amount' => $user->amount,
                        'status' => 0
                    ];

                    Transaction::create($data);

                    return false;
                }


                $data = [
                    'user_id' => $user->id,
                    'amount' => $user->amount,
                    'status' => 1
                ];

                Transaction::create($data);

                return true;
            });

            return $log;
        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th);
        }
    }
}