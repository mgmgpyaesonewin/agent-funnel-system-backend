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
 * @property string $file_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ImportHistory whereFileName($value)
 */
class ImportHistory extends Model
{
    //
    public $table = 'import_history';
}
