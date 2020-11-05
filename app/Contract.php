<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Contract
 *
 * @property int $id
 * @property string|null $pdf
 * @property string|null $agreement_no
 * @property string|null $signed_date
 * @property string|null $applicant_sign_img
 * @property string|null $witness_name
 * @property string|null $witness_sign_img
 * @property int $version
 * @property int $applicant_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereAgreementNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereApplicantSignImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract wherePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereSignedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereWitnessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Contract whereWitnessSignImg($value)
 * @mixin \Eloquent
 */
class Contract extends Model
{
    public function applicant()
    {
        return $this->belongsTo('App\Applicant');
    }

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->agreement_no = "Version {$model->id}";
            $model->save();
        });
    }
}
