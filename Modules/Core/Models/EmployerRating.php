<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Project\Models\ProjectProposal;
use Modules\Employer\Models\Employer;
use Moduls\Freelancer\Models\Freelancer;

class EmployerRating extends Model
{
    // Rating Employer to Freelancer
    protected $fillable = [
        'employer_id', 'freelancer_id', 'project_proposal_id', 'quality', 'review'
    ];

    protected $appends = ['ratepayer'];

    protected $casts = [
        'quality' => 'integer',
    ];
    public function getRatepayerAttribute()
    {
        $employer = $this->employer();
        return 'ratepayer';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function proposal()
    {
        return $this->belongsTo(ProjectProposal::class, 'project_proposal_id', 'id');
    }
}
