<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\BopSession
 *
 * @property int $id
 * @property string $title
 * @property string $session
 * @property string $url
 * @property integer enable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Applicant[] $applicants
 * @property-read int|null $applicants_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\BopSession whereUrl($value)
 * @mixin \Eloquent
 */
class BopSession extends Model
{
    protected $table = 'bop_sessions';
    protected $guarded = [];

    public function getDate()
    {
        return Carbon::parse($this->session)->format('d-m-Y');
    }

    public function getViberDateFormat()
    {
        return Carbon::parse($this->session)->format('jS \\of F Y \\(l\\) h:i A');
    }

    public function getTime()
    {
        return Carbon::parse($this->session)->format('h:i A');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeEnable($query)
    {
        return $query->where('enable', 1);
    }

    public function applicants()
    {
        return $this->belongsToMany('App\Applicant', 'applicant_bop_session')->withPivot('attendance_status')->withTimestamps();
    }
}
