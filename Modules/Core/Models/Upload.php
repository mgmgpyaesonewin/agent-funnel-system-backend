<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $appends = ['link'];
    protected $fillable = [
      'file_name','file_type','file_path','name','domain','show',
    ];

    /**
     * @return string
     * 
     */
    public function test () {
      return 'test';
    }
    public function getLinkAttribute()
    {
        return $this->attributes['link'] = $this->domain.$this->file_path.$this->file_name.'.'.$this->file_type;
    }
}
