<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\DatabaseNotification;
use Carbon\Carbon;

class Notification extends DatabaseNotification
{
    protected $appends = ['date'];

    public function getDateAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }
}
