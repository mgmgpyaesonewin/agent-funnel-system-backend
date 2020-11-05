<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TemplateForm
 *
 * @property int $id
 * @property int $preferred_name
 * @property int $name
 * @property int $nrc
 * @property int $nrc_photo
 * @property int $dob
 * @property int $gender
 * @property int $myanmar_citizen
 * @property int $citizenship
 * @property int $race
 * @property int $marital_status
 * @property int $address
 * @property int $city
 * @property int $township
 * @property int $contact_no
 * @property int $alternate_no
 * @property int $highest_qualification
 * @property bool $email
 * @property int $conflict_interest
 * @property int $term_condition
 * @property array|null $additional_info
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $template_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereAdditionalInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereAlternateNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereCitizenship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereConflictInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereContactNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereHighestQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereMyanmarCitizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereNrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereNrcPhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm wherePreferredName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereRace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereTemplateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereTermCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereTownship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TemplateForm whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TemplateForm extends Model
{
    protected $guarded = [];

    protected $casts = [
        'email' => 'boolean',
        'additional_info' => 'array',
    ];
}
