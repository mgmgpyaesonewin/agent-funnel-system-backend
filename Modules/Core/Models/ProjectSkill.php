<?php

namespace Modules\Core\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Project\Models\Project;
use Modules\Project\Models\Skill;
use Uni;


class ProjectSkill extends Model
{
    protected $fillable = [
        'project_id','skill_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    

}

