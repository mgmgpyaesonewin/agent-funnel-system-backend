<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\Training
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $enable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Applicant[] $applicants
 * @property-read int|null $applicants_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Training onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Training whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Training withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Training withoutTrashed()
 * @mixin \Eloquent
 */
class Training extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function applicants()
    {
        return $this->belongsToMany('App\Applicant');
    }

    public function scopeEnable($query)
    {
        return $query->where('enable', 1);
    }

    public function getTrainingTotalAssigned()
    {
        return DB::table('applicant_status')
            ->where('current_status', 'pmli_filter')
            ->where('status_id', '3')
            ->where('created_at', '>=', $this->created_at)
            ->count();
    }
}
