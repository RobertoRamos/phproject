<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueUpdateData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'issue_update_data';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Get the main update record
     */
    public function issueUpdate()
    {
        return $this->belongsTo('App\IssueUpdate', 'update_id');
    }
}
