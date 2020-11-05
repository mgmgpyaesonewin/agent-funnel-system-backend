<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Interview
 *
 * @property int $id
 * @property string $appointment
 * @property string $url
 * @property int $rescheduled
 * @property int|null $applicant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $date
 * @property-read mixed $time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereAppointment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereRescheduled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Interview whereUrl($value)
 * @mixin \Eloquent
 */
class Interview extends Model
{
    protected $guarded = [];

    public function getDateAttribute()
    {
        return Carbon::parse($this->appointment)->toDateString();
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->appointment)->format('g:i A');
    }
}
