<?php

namespace Modules\Core\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Kyawnaingtun\Tounicode\TounicodeTrait;
//models
//utility
use Modules\Core\Models\Employer;
use Modules\Core\Models\ProjectProposal;
use Modules\Core\Models\Category;
use Modules\Core\Models\SubCategory;
use Modules\Core\Models\Skill;
use Modules\Core\Models\City;
// use Modules\Freelancer\Models\Freelancer;

class Project extends Model
{
    //use TounicodeTrait;
    use SoftDeletes;

    protected $appends = ['apply_allow_status', 'apply_allow_message', 'applied_status', 'work_location_address', 'readable_close_date', 'avg_bid_amount', 'time_left', 'proposal_count', 'hired_proposal'];

    protected $fillable = [
        'project_ref', 'employer_id', 'sub_category_id', 'title', 'canonical_link', 'desc', 'interview', 'project_type_id', 'experience', 'freelancer_count', 'duration', 'duration_type', 'max_budget', 'min_budget', 'negotiate', 'currency', 'location', 'code', 'city_id', 'work_address', 'posted_date', 'close_date', 'completed_date', 'status', 'edited_date', 'request_completed_date'
    ];

    protected $dates = [
        'deleted_at', 'posted_date', 'close_date', 'completed_date', 'edited_date',
    ];

    protected $softDelete = true;
    // unicode convertable
    protected $convertable = ['title', 'desc'];

    protected $casts = [
        'negotiate' => 'boolean',
        'completed_date' => 'date',
        'close_date' => 'date',
    ];
    /**
     * ----------------------------------------------------------------------------
     * RELATIONSHIP FUNCTIONS
     * ----------------------------------------------------------------------------
     */
        public function employer()
        {
            return $this->belongsTo(Employer::class);
        }

        public function city()
        {
            return $this->belongsTo(City::class);
        }

        public function proposals()
        {
            return $this->hasMany(ProjectProposal::class);
        }

        public function hiredProposal()
        {
            return $this->hasOne(ProjectProposal::class);
        }

        public function project_skill()
        {
            return $this->belongsToMany(Skill::class,'project_skills');
        }

        public function required_skill()
        {
            return $this->belongsToMany(Skill::class, 'project_skills')->select('name');
        }

        public function pricing()
        {
            return $this->belongsTo(ProjectPricing::class);
        }

        public function subCategory()
        {
            return $this->belongsTo(SubCategory::class);
        }

        public function skills()
        {
            return $this->belongsToMany(Skill::class, 'project_skills');
        }

        public function category()
        {
            return $this->belongsTo(Category::class);
        }
    
    /**
     * ----------------------------------------------------------------------------
     * GETTER ATTRIBUTES
     * ----------------------------------------------------------------------------
     */
        
    /**
     * ----------------------------------------------------------------------------
     * SETTER ATTRIBUTES
     * ----------------------------------------------------------------------------
     */
        // here setter functions
    /**
     * ----------------------------------------------------------------------------
     * APPENDED NEW ATTRIBUTES (GETTER)
     * ----------------------------------------------------------------------------
     */
        /**
         * checker
         *
         * @return void
         */
        protected function checkAllow()
        {
            $status = true;
            if (Auth::check()) {
                if (Auth::user()->role_id == 2) {
                    if (Auth::user()->freelancer->star < 3) { // if not premium freelancer
                        //1 = Standard
                        //3 = Premium
                        //4 = Enterprise
                        //8 = Enterprise(AE)
                        if ($this->attributes['project_pricing_id'] == 3) {
                            $status = false;
                        }
                    }
                }
            }
            return $status;
        }
        /**
         * Attribute: apply_allow_status
         *
         * @return void
         */
        public function getApplyAllowStatusAttribute()
        {
            return $this->checkAllow();
        }
        /**
         * Attribute: apply_allow_message
         *
         * @return void
         */
        public function getApplyAllowMessageAttribute()
        {
            $messasge = '';
            if (!$this->checkAllow()) {
                $messasge = "Only 3 stars to 5 stars freelancers are allowed to apply this project.";
            }
            return $messasge;
        }
        /**
         * Attribute: time_left
         *
         * @return void
         */
        public function getTimeLeftAttribute()
        {
            return date_diff(new \DateTime($this->attributes['close_date']), new \DateTime())->format("%d days");
            // return $this->close_date->diffInHours(now());
            //return $this->close_date->diff(now())->format("%d days");
        }
        /**
         * Attribute: applied_status
         *
         * @return void
         */
        public function getAppliedStatusAttribute()
        {
            if (Auth::check() && Auth::user()->role_id == 2) {
                $appliedProposalData = ProjectProposal::where('freelancer_id', Auth::user()->freelancer->id)->where('project_id', $this->attributes['id'])->first();
                if ($appliedProposalData) {
                    return true;
                }
            }
            return false;
        }
        /**
         * Attribute: readable_close_date
         *
         * @return void
         */
        public function getReadableCloseDateAttribute()
        {
            if($this->close_date != null)
                return $this->close_date->format('d M Y');
        }
        /**
         * Attribute: work_location_address
         *
         * @return void
         */
        public function getWorkLocationAddressAttribute()
        {
            $location = "Online";
            if ($this->location == 1) { //offline
                $city_name = $this->city->name;
                $work_address = $this->work_address;
                $location = $work_address . ', ' . $city_name;
            }

            return $location;
        }
        /**
         * Attribute: avg_bid_amount
         *
         * @return void
         */
        public function getAvgBidAmountAttribute()
        {
            $amount = 0;
            $avgAmount = ProjectProposal::where('project_id', $this->id)->avg('total_amount');
            if ($avgAmount) {
                $amount = $avgAmount;
            }
            return round($amount);
        }
        /**
         * Attribute: proposal_count
         *
         * @return void
         */
        public function getProposalCountAttribute()
        {
            $proposal = ProjectProposal::where('project_id', $this->id)->where(function ($query) {
                $query->where('status', '=', "pending")
                    ->orWhere('status', '=', "hired")
                    ->orWhere('status', 'edited');
            })->count();
            return $proposal;
        }

        /**
         * Attribute: hired_proposal
         *
         * @return void
         */
        public function getHiredProposalAttribute()
        {
            $proposal = ProjectProposal::where('project_id', $this->id)
                ->where('status', '=', "hired")
                ->first();
            return $proposal;
        }
    
    /**
     * ----------------------------------------------------------------------------
     * GLOBAL AND LOCAL SCOPES
     * ----------------------------------------------------------------------------
     */
        public function scopeOpen($query){ 
            return $query->where('status', 'open');
        }
        /**
         * For three to five star freelancers
         *
         * @param [type] $query
         * @return void
         */
        public function scopeForThreeToFiveStarFreelancer($query)
        {
            return $query->whereIn('project_pricing_id', ['3', '4', '8']);
        }
        /**
         * For one to two star freelancer
         *
         * @param [type] $query
         * @return void
         */
        public function scopeForOneToTwoStarFreelancer($query)
        {
            return $query->whereIn('project_pricing_id', ['1', '3', '4', '8']);
        }
        
}

