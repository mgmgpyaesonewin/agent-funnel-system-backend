<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function applicant()
    {
        return $this->belongsTo('App\Applicant');
    }

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->agreement_no = str_pad($model->id, 5, '0', STR_PAD_LEFT);
            $model->save();
        });
    }
}
