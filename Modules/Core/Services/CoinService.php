<?php

namespace  Modules\Core\Services;

use Illuminate\Support\Facades\Log;
//models
use Modules\User\Models\User;
use Modules\Core\Models\CreditTransaction;
use Carbon\Carbon;
class CoinService
{
    
    public function __construct()
    {
        
    }

    static function increase($userId, $amount)
    {
        $user = User::find($userId);
        $user->credit += $amount;
        $user->save();
    }

    static function decrease($userId, $amount)
    {
        $user = User::find($userId);
        $user->credit -= $amount;
        $user->save();
    }
}
