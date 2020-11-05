<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Partner
 *
 * @property int $id
 * @property string $company_name
 * @property string $pic_name
 * @property string $pic_phone
 * @property string $pic_email
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Applicant[] $applicants
 * @property-read int|null $applicants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner wherePicEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner wherePicName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner wherePicPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Partner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Partner extends Model
{
    protected $fillable = ['company_name', 'pic_name', 'pic_phone', 'pic_email'];

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function applicants()
    {
        return $this->hasMany('App\Applicant');
    }
}
