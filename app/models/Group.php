<?php

use Cartalyst\Sentinel\Groups\EloquentGroup;

class Group extends EloquentGroup {

    public function getIdAttribute($id)
    {
        return (int) $id;
    }

}
