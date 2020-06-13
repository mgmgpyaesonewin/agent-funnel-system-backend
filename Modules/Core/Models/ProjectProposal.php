<?php


namespace Modules\Core\Models;
use Illuminate\Database\Eloquent\Model;
use Modules\Freelancer\Models\Freelancer;
use Modules\Freelancer\Models\EmployerRating;
use Carbon\Carbon;

class ProjectProposal extends Model
{
    protected $table = 'project_proposals';

    // protected $appends = ['name','freelancer_review','employer_review','is_edit'];

    protected $fillable =[
        'project_id','freelancer_id','total_amount','commission','paid_amount','duration','duration_type','desc','applied_date','status','edited_date','hired_date','interview'
    ];

    //protected $visible = ['total_amount','duration','duration_type','reason'];
    protected $dates = ['applied_date','edited_date','hired_date'];

    /**
     * ----------------------------------------------------------------------------
     * RELATIONSHIP FUNCTIONS
     * ----------------------------------------------------------------------------
     */
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * 
         */
        public function project()
        {
            return $this->belongsTo(Project::class);
        }

        /**
         * @return mixed
         * 
         */

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * 
         */
        public function freelancer()
        {
            return $this->belongsTo(Freelancer::class);
        }

        /**
         * @return mixed
         * 
         */
        public function interview_table()
        {
            return $this->hasMany(Interview::class)->orderBy('status','desc');
        }
    /**
     * ----------------------------------------------------------------------------
     * GETTER ATTRIBUTES
     * ----------------------------------------------------------------------------
     */
        /**
         * @return string
         * 
         */
        public function getIsEditAttribute()
        {
            // $now = Carbon::now();
            // return $this->attributes['is_edit'] = ($this->applied_date->diff($now)->days < 1) ? 'today': $this->applied_date->diffForHumans($now);
        }

        /**
         * @return bool
         * 
         */
        public function getFreelancerReviewAttribute()
        {
            // $project = FreelancerRating::where('project_id',$this->project->id)->first();
            // if (isset($project)) {
            //     return $this->attributes['freelancer_review'] = false;
            // }
            // return $this->attributes['freelancer_review'] = true;
        }

        /**
         * @return bool
         * 
         */
        public function getEmployerReviewAttribute()
        {
            $proposal = EmployerRating::where('project_proposal_id',$this->id)->first();
            if (isset($proposal)) {
                return $this->attributes['employer_review'] = true;
            }
            return $this->attributes['employer_review'] = false;
        }

        /**
         * @return mixed
         * 
         */
        public function getNameAttribute()
        {
            // return $this->attributes['name'] = $this->freelancer->name;
        }
    /**
     * ----------------------------------------------------------------------------
     * GLOBAL AND LOCAL SCOPES
     * ----------------------------------------------------------------------------
     */
        /**
         * @param $query
         * @return mixed
         * 
         */
        public function scopeHired($query)
        {
            return $query->whereStatus('Hired')->get();
        }

        /**
         * @param $query
         * @return int
         * 
         */
        public function scopeBidCount($query)
        {
            $query->whereprojectId($this->id)->get();
            return count($query);
        }

        /**
         * @param $query
         * @param $user_id
         * @param $project_id
         * @return mixed
         * 
         */
        public function scopeApplyProject($query, $user_id, $project_id)
        {
            $query->wherefreelancerId($user_id)->whereprojectId($project_id)->get();

            return $query;
        }
}
