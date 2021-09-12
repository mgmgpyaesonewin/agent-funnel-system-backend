<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'pic_name', 'pic_phone', 'pic_email'];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function applicants()
    {
        return $this->hasMany('App\Applicant');
    }
}
