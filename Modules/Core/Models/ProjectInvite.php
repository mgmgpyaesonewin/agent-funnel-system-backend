<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInvite extends Model
{
    protected $fillable = ['project_id','freelancer_id','employer'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author TintNaingWin
     */
    public function project(){
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author TintNaingWin
     */
    public function freelancer(){
        return $this->belongsTo(Freelancer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employer(){
        return $this->belongsTo(Employer::class);
    }
}
