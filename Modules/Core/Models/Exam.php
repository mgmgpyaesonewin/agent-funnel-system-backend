<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';
    protected $table = 'exams';
}