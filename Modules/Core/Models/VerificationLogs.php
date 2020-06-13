<?php

namespace Modules\Core\Models;

use Modules\User\Models\User;
use Modules\Project\Models\Project;
use Modules\Core\Models\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class VerificationLogs extends Model
{
    

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
