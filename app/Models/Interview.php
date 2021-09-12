<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getDateAttribute()
    {
        return Carbon::parse($this->appointment)->toDateString();
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->appointment)->format('g:i A');
    }
}
