<?php
namespace Modules\Core\Models;

use Moloquent;

class Message extends Moloquent{
    protected $connection = 'mongodb';
    protected $collection = 'message';

    protected $dates = ['created_on'];

    protected $casts = [
        'userid' => 'integer'
    ];

    public function getMessagesAttribute($value){
        // Order of replacement
        $order   = array("\r\n", "\n", "\r");
        $replace = '';
        
        // Processes \r\n's first so they aren't converted twice.
        return str_replace($order, $replace, $value);
    }

    public function room(){
        return $this->belongsTo(\App\ChatRoom::class, 'room')->oldest();
    }
}