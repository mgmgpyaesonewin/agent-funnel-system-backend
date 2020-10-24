<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the user "created" event.
     */
    public function created(User $user)
    {
        $user->utm_source = $this->generateUtmSource($user->name, $user->id);
    }

    /**
     * Handle the user "updating" event.
     */
    public function updating(User $user)
    {
        $user->utm_source = $this->generateUtmSource($user->name, $user->id);
    }

    protected function generateUtmSource(string $name, int $id): string
    {
        // convert str to lowercase
        $str_lower = Str::lower($name);

        // covert lower_str to slug
        $slug_str = Str::slug($str_lower, '');

        // concat the ID Number so that slug is unique
        return "{$slug_str}.{$id}";
    }
}
