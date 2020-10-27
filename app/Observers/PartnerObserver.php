<?php

namespace App\Observers;

use App\Partner;
use Illuminate\Support\Str;

class PartnerObserver
{
    /**
     * Handle the partner "creating" event.
     */
    public function creating(Partner $partner)
    {
        $partner->slug = Str::slug($partner->company_name);
    }
}
