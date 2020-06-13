<?php

namespace Modules\User\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Translation\HasLocalePreference;
// modules
use Modules\Employer\Models\Employer;
use Modules\Freelancer\Models\Freelancer;
use Modules\Core\Models\BankAccount;
use Modules\Core\Models\CreditTransaction;
use Modules\Core\Models\Notification;

use Mrlinnth\Lasinkyay\Contracts\PlanSubscriberInterface;
use Mrlinnth\Lasinkyay\Traits\PlanSubscriber;
use Mrlinnth\Lasinkyay\Models\PlanSubscription;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, PlanSubscriberInterface, HasLocalePreference
{
    use HasApiTokens, Notifiable, PlanSubscriber;

    protected $appends = ['is_pfc_member'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','name', 'profile_setup_step', 'profile_img','role_id','activation_code','last_login','status','seen','f_set_up','e_set_up','lang','credit'
    ];

    protected $date =['last_login'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    /**
     * Get the user's preferred locale.
     *
     * @return string
     */
    public function preferredLocale()
    {
        return $this->lang;
    }

    /**
     * One to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get user statut
     *
     * @return string
     */
    public function getStatus()
    {
        if ($this->role_id != null) {
            return $this->role->slug;
        }else {
            return 'visitor';
        }
    }

    public function getVerificationBarAttribute() 
    {
        if ($this->role_id === 2) {
            return $this->freelancer->verification_bar;
        }
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function social() {
        return $this->hasOne(Social::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * 
     */
    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 
     */
    public function bank()
    {
        return $this->hasMany(BankAccount::class);
    }
    // TODO: to check again
    
    public function pfc()
    {
        return $this->hasMany(PlanSubscription::class, 'subscribable_id');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')
            ->orderBy('created_at', 'desc');
    }
    
    // public function notifications()
    // {
    //     return $this->hasOne(Notification::class);
    // }

    /**
     * @return bool
     * 
     */
    public function getChangeAccount()
    {
        if ($this->e_set_up == 'yes' && $this->f_set_up == 'yes') {
            return true;
        }
        return false;
    }

    /**
     * @param $query
     * @param $subcategory
     * @param $city
     * @return mixed
     * 
     */
    public function scopeSearchByCity($query, $subcategory, $city)
    {
        $query->where('freelancer', function($query) use($subcategory,$city) {
                $query->whereHas('job_title', function($query) use($subcategory,$city) {
                        $query->where('sub_category_id', '=', $subcategory);
                })->where('city_id','=',$city);
            })->get();

        return $query;
    }

    public function transition()
    {
        return $this->hasMany(CreditTransaction::class);
    }

    public function contest()
    {
        return $this->hasMany(ContestUploads::class);
    }

    //getter
    public function getIsPfcMemberAttribute()
    {
        return false;
        $plan = $this->subscription('main');
        if (!empty($plan)) {
            if ($plan->is_pending == 0) {
                return true;
            }
        }
        return false;
    }
}
