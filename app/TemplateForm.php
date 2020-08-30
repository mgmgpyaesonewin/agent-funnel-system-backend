<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateForm extends Model
{
    protected $guarded = [];

    protected $casts = [
        'email' => 'boolean',
        'additional_info' => 'array',
    ];
}
