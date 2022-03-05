<?php

namespace Source\Models;

class Status extends \CoffeeCode\DataLayer\DataLayer
{
    public function __construct()
    {
        parent::__construct("status", ["name"]);
    }
}