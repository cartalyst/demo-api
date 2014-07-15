<?php

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser {

    public function getIdAttribute($id)
    {
        return (int) $id;
    }

}
