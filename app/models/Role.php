<?php

use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole {

    public function getIdAttribute($id)
    {
        return (int) $id;
    }

}
