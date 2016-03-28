<?php

class UsersGroup extends Eloquent{

    /**
     * User Groups Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  - 	group_name VARCHAR(60)
     *  - 	created_at TIMESTAMP
     *  - 	updated_at TIMESTAMP
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_groups';

    /**
     * define relationships
     */
    public function users()
    {
        return $this->hasMany('User', 'id');
    }
}