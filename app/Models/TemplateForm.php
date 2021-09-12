<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'email' => 'boolean',
        'additional_info' => 'array',
    ];
}
