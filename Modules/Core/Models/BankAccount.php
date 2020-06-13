<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'user_id','payee_name','bank_name','card_number','verify','card_type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
