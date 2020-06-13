<?php

namespace Modules\Core\Models;


use DB;
use Modules\Freelancer\Models\Freelancer;
use Modules\Core\Models\VerificationRules;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VerificationDetails extends Authenticatable
{
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
    public function verification_rules()
    {
        return $this->belongsTo(VerificationRules::class);
    }
}
