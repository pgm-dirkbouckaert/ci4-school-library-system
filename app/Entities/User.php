<?php namespace App\Entities;

use Myth\Auth\Entities\User as MythUser;

class User extends MythUser
{   
    /**
     * Returns Email
     *
     * @return string
     */
    public function getEmail()
    {
        return trim(trim($this->attributes['email']));
    }
    public function getId()
    {
        return trim(trim($this->attributes['id']));
    }
}