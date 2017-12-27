<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueUpdate extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Get the issue
     */
    public function issue()
    {
        return $this->belongsTo('App\Issue', 'issue_id');
    }

    /**
     * Get the user
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the updated field data
     */
    public function updateData()
    {
        return $this->hasMany('App\IssueUpdateData', 'update_id');
    }
}
