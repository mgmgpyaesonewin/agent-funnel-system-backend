<?php

namespace App\Observers;

use App\Models\Partner;
use Illuminate\Support\Str;

class PartnerObserver
{
    /**
     * Handle the partner "creating" event.
     */
    public function creating(Partner $partner): void
    {
        // convert str to lowercase
        $company_name = Str::lower($partner->company_name);

        $partner->slug = Str::slug($company_name, '');
    }
}

