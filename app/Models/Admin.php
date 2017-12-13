<?php

/**
 * Class: Admin
 *
 * @see BaseModel
 */

class Admin extends BaseModel
{

    /**
     *
     * @var define relationships
     */
    public function role()
    {
        return $this->hasOne('UserRole','id','role_id');
    }
    
    public function user()
    {
        return $this->belongsTo('User','user_id','id');
    }

    
}
