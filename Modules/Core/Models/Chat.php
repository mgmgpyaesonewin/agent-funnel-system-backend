<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Chat extends Eloquent

{
   protected $connection = 'cs_chat';
   protected $collection = "message_collection";
}
