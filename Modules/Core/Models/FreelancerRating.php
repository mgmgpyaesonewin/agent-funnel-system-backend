<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Project\Models\Project;

class FreelancerRating extends Model
{
    // Freelancer to Employer

    protected $fillable = [
      'freelancer_id','project_id','quality','review'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author TintNaingWin
     */
    public function project()
    {
      return $this->hasOne(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author TintNaingWin
     */
    public function freelancer()
    {
      return $this->hasOne(Freelancer::class);
    }
}
