<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Status.
 *
 * @property int                             $id
 * @property string                          $title
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Status whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Applicant[] $applicants
 * @property-read int|null $applicants_count
 */
class Status extends Model
{
    public function applicants()
    {
        return $this->belongsToMany('App\Applicant')->withPivot('current_status')->withTimestamps();
    }
}
