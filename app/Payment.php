<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Payment
 *
 * @property int $id
 * @property string $date
 * @property int $amount
 * @property int|null $partner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Partner|null $partner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    protected $fillable = ['date', 'amount', 'partner_id'];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }
}
