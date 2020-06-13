<?php

namespace Modules\Core\Models;

// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Kyawnaingtun\Tounicode\TounicodeTrait;
use Uni;
// models
use Modules\User\Models\User;
use Modules\Core\Models\SubCategory;
use Modules\Core\Models\Category;
use Modules\Core\Models\Upload;
use Modules\Core\Models\City;
use Modules\Core\Models\Country;
use Modules\Core\Models\Endorsement;
use Modules\Core\Models\Skill;
use Modules\Core\Models\SkillTest;
use Modules\Core\Models\VerificationDetails;
use Modules\Freelancer\Models\EmployerRating;
use Modules\Freelancer\Models\FreelancerEducation;
use Modules\Freelancer\Models\FreelancerPortfolio;
use Modules\Project\Models\ProjectProposal;

class Freelancer extends Model
{
    use TounicodeTrait;

    protected $appends = ['verification_bar', 'completed_proposal'];  

    protected $fillable = [
        'user_id',
        'eng_proficiency',
        'category_id',
        'overview',
        'address',
        'city_id',
        'star',
        'subscribe',
        'verify',
        'country_id',
        'ban_reason',
        'phone_verification'
    ];

    protected $convertable = ['overview', 'address'];
    /**
     * ----------------------------------------------------------------------------
     * RELATIONSHIP FUNCTIONS
     * ----------------------------------------------------------------------------
     */
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * 
         */
        public function category()
        {
            return $this->belongsTo(Category::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * 
         */
        public function city()
        {
            return $this->belongsTo(City::class);
        }

        public function country()
        {
            return $this->belongsTo(Country::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         * 
         */
        public function ratings()
        {
            return $this->hasMany(EmployerRating::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * 
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         * 
         */
        public function freelancer_portfolio()
        {
            return $this->hasMany(FreelancerPortfolio::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         * 
         */
        public function freelancer_skill()
        {
            return $this->belongsToMany(Skill::class,'freelancer_skills');
        }
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         * 
         */
        // to get from SubCategories TBL
        public function job_title()
        {
            return $this->belongsToMany(SubCategory::class, 'job_titles', 'freelancer_id', 'sub_category_id');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         * 
         */
        public function job_category()
        {
            return $this->belongsToMany(Category::class, 'job_categories', 'freelancer_id', 'category_id');
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         * 
         */
        public function education()
        {
            return $this->hasMany(FreelancerEducation::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         * 
         */
        public function proposals()
        {
            return $this->hasMany(ProjectProposal::class);
        }
        
        public function skill_test()
        {
            return $this->hasMany(SkillTest::class);
        }

        public function endorsement()
        {
            return $this->hasMany(Endorsement::class);
        }

        public function verification_details()
        {
            return $this->hasMany(VerificationDetails::class);
        }

        public function proposalCountRelation($status)
        {
            return $this->hasOne(ProjectProposal::class)->where('status',$status)->groupBy('freelancer_id');
        }

        public function portfolio()
        {
            return $this->belongsToMany(Upload::class, 'freelancer_portfolios');
        }
        
    /**
     * ----------------------------------------------------------------------------
     * GETTER ATTRIBUTES
     * ----------------------------------------------------------------------------
     */
        /**
         * @return \Illuminate\Contracts\Routing\UrlGenerator|string
         * 
         */
        public function getUrlAttribute()
        {
            return $this->attributes['url'] = url('freelancer/profile/'.$this->id);
        }

        /**
         * @return mixed
         * 
         */
        public function getNameAttribute()
        {
            return $this->attributes['name'] = $this->user->name;
        }

        public function getCompletedProposalAttribute()
        {
            return $this->attributes['completed_proposal'] = $this->getProposalCount('completed');
        }
        /**
         * @return mixed
         * 
         */
        public function getProposalCount($status)
        {
            return $this->proposalCountRelation($status)->count();
        }

        public function getAppliedProject() {
            $id = $this->id;
            return ProjectProposal::whereHas('project', function ($query) {
                $query->where('status', '=', 'open');
            })->where('freelancer_id', $id)->whereIn('status',['pending', 'edited', 'hired'])->orderBy('id','desc')->get();
        }

        public function getOnGoingProject() {
            $id = $this->id;
            return ProjectProposal::whereHas('project', function ($query) {
                $query->where('status', '=', 'in-progress');
            })->where('freelancer_id', $id)->whereIn('status',['hired'])->orderBy('id','desc')->get();
        }

        public function getPastProject() {
            $id = $this->id;
            return ProjectProposal::whereHas('project', function ($query) {
                $query->whereIn('status', ['cancelled', 'deleted', 'rejected', 'expired', 'completed']);
            })->where('freelancer_id', $id)->whereIn('status',['cancel', 'deleted', 'completed'])->orderBy('id','desc')->get();
        }
    /**
     * ----------------------------------------------------------------------------
     * APPENDED NEW ATTRIBUTES (GETTER)
     * ----------------------------------------------------------------------------
     */
        public function getVerificationBarAttribute() 
        {
            // true -> show verification noti bar in _navbar.blade.php
            // false -> hide verification noti bar in _navbar.blade.php
            if($this->user->role_id === 2 && $this->user->f_set_up == 'yes') {
                $verification_status = $this->attributes['verification_status'];
                if ($verification_status == 'approved') {
                    return false; // approved verification
                }
                return true; // need to approve
            }
            return false; // not a freelancer OR before freelancer profile setup
        }
}