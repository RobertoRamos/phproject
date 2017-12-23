<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'deleted_date'
    ];

    /**
     * Get the type of the issue
     */
    public function type()
    {
        return $this->belongsTo('App\IssueType', 'type_id');
    }

    /**
     * Get the status of the issue
     */
    public function status()
    {
        return $this->belongsTo('App\IssueStatus', 'status_id');
    }

    /**
     * Get the priority of the issue
     */
    public function priority()
    {
        return $this->belongsTo('App\IssuePriority', 'priority_value', 'value');
    }

    /**
     * Get the author of the issue
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * Get the owner of the issue
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    /**
     * Get the parent issue, if any
     */
    public function parent()
    {
        return $this->belongsTo('App\Issue', 'parent_id');
    }

    /**
     * Get the child issues, if any
     */
    public function children()
    {
        return $this->hasMany('App\Issue', 'parent_id');
    }
}
