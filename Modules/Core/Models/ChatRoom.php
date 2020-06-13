<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;
use Modules\Freelancer\Models\Freelancer;
use Modules\Project\Models\ProjectProposal;
use Modules\Project\Models\Project;

class ChatRoom extends Model

{
    public $table = "chat_rooms";
    public $timestamps = true;
    const UPDATED_AT = null;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'role_id',
        'project_id',
        'project_proposal_id',
        'freelancer_id',
        'room_type',
        'room_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project() 
    {
        return $this->belongsTo(Project::class);
    }

    public function project_proposal() 
    {
        return $this->belongsTo(ProjectProposal::class);
    }
}
