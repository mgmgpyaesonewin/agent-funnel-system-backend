<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

  /**
   * One to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\hasMany
   */
  public function users()
  {
      return $this->hasMany(User::class);
  }

}
