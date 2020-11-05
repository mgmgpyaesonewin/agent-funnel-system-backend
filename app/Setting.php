<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reason
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reason whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $meta_key
 * @property string|null $meta_value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereMetaKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Setting whereMetaValue($value)
 */
class Setting extends Model
{
    //
}
