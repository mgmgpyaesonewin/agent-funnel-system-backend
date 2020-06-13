<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

use App\TraningSchool;

class SkillTest extends Model
{
    public function training_school()
    {
        return $this->belongsTo(TrainingSchool::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
