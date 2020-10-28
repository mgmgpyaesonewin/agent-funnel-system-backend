<?php

namespace App\Services;

use App\Services\Interfaces\ApplicantServiceInterface;
use App\Setting;
use App\User;

class ApplicantService implements ApplicantServiceInterface
{
    public function getUserToAssign(): int
    {
        $user_id = (int) Setting::where('meta_key', 'auto_assign_ma_user_current_id')->first()->meta_value;

        if (0 === $user_id || empty(User::where('id', '>', $user_id)->ma()->min('id'))) {
            return User::ma()->first()->id;
        }

        return User::where('id', '>', $user_id)->ma()->min('id');
    }
}
