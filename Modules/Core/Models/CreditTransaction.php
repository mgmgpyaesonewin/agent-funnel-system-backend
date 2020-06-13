<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class CreditTransaction extends Model
{
    public $table = 'credit_transitions';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function getDateAttribute() {
    //     return $this->date;
    //     // return date(‘d/m/Y’, strtotime($this->date));
    // }
}
