<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSchool extends Model
{
    public function endorse()
    {
        return $this->hasOne(Endorsement::class);
    }

}
