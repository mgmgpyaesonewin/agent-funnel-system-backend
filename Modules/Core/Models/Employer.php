<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//
use Kyawnaingtun\Tounicode\TounicodeTrait;
//models
//utility
use Uni;
use Modules\Project\Models\ProjectProposal;
use Modules\Core\Models\Category;
use Modules\Core\Models\SubCategory;
use Modules\Core\Models\Skill;
use Modules\User\Models\User;
use Modules\Core\Models\Industry;



class Employer extends Model
{
    use TounicodeTrait;

    protected $fillable = [
        'user_id','company_name', 'company_desc','industry_id','overview','address','phone','profile_img','channel','city_id'
    ];

    /**
     * ----------------------------------------------------------------------------
     * RELATIONSHIP FUNCTIONS
     * ----------------------------------------------------------------------------
     */
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * @author nnh
         */
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         * 
         */
        public function industry()
        {
            return $this->belongsTo(Industry::class);
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
     * ----------------------------------------------------------------------------
     * GETTER ATTRIBUTES
     * ----------------------------------------------------------------------------
     */
        // public function getPendingProject() {
        //     $id = $this->id;
        //     return Project::where('employer_id', $id)->whereStatus('pending')->orderBy('id','desc')->get();
        // }
        // public function getPostedProject() {
        //     $id = $this->id;
        //     return Project::where('employer_id', $id)->whereStatus('open')->orderBy('id','desc')->get();
        // }
        // public function getOnGoingProject() {
        //     $id = $this->id;
        //     return Project::where('employer_id', $id)->whereStatus('in-progress')->orderBy('id','desc')->get();
        // }
        // public function getPastProject() {
        //     $id = $this->id;
        //     return Project::where('employer_id', $id)->whereStatus('completed')->orderBy('id','desc')->get();
        // }
}

