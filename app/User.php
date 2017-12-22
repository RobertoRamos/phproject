<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'deleted_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all authored issues
     */
    public function authoredIssues()
    {
        return $this->hasMany('Issue', 'author_id');
    }

    /**
     * Get all assigned (owned) issues
     */
    public function ownedIssues()
    {
        return $this->hasMany('Issue', 'owner_id');
    }
}
