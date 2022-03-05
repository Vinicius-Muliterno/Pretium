<?php

namespace Source\Models;

class User extends \CoffeeCode\DataLayer\DataLayer
{
    public function __construct()
    {
        parent::__construct("users", ["username", "email", "password", "provider_id"]);
    }

    public function provider(): ?Provider
    {
        if($this->provider_id){
            return ((new Provider())->findById($this->provider_id));
        }
        return null;
    }
}