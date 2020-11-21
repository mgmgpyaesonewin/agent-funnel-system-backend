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
        // convert str to lowercase
        $company_name = Str::lower($partner->company_name);

        $partner->slug = Str::slug("{$company_name}", '');
    }
}

