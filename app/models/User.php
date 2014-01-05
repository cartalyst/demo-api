<?php

use Cartalyst\Sentry\Users\EloquentUser;

class User extends EloquentUser {

    public function getIdAttribute($id)
    {
        return (int) $id;
    }

}
