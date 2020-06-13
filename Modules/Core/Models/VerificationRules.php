<?php

namespace Modules\Core\Models;

use Modules\Core\Models\VerificationDetails;
use Illuminate\Database\Eloquent\Model;


class VerificationRules extends Model
{
    

    public function verification_details()
    {
        return $this->hasMany(VerificationDetails::class);
    }
}
