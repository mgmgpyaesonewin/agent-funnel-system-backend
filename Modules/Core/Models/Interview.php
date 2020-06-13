<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Employer\Models\Employer;
use Modules\Project\Models\ProjectProposal;
use Modules\Project\Models\Project;

class Interview extends Model
{
    protected $fillable = [
       'employer_id','project_proposal_id','project_id','interview_date','interview_time','location','status','employer_status'
    ];

    protected $dates = [
        'interview_date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author TintNaingWin
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author TintNaingWin
     */
    public function project()
    {
       return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author TintNaingWin
     */
    public function proposal()
    {
        return $this->belongsTo(ProjectProposal::class,'project_proposal_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author TintNaingWin
     */
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
}
