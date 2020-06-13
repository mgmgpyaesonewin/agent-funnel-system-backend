<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Endorsement extends Model
{
    public function training_school()
    {
        return $this->belongsTo(TrainingSchool::class);
    }
    // public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
