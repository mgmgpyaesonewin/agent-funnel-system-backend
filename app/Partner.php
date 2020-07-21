<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['company_name', 'pic_name', 'pic_phone', 'pic_email'];
}
