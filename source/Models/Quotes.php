<?php

namespace Source\Models;

class Quotes extends \CoffeeCode\DataLayer\DataLayer
{
    public function __construct()
    {
        parent::__construct("quotes", ["user_id", "provider_id", "status_id", "closure_at"]);
    }

    public function user(): ?User
    {
        if($this->user_id){
            return ((new User())->findById($this->user_id));
        }
        return null;
    }

    public function provider(): ?Provider
    {
        if($this->provider_id){
            return ((new Provider())->findById($this->provider_id));
        }
        return null;
    }

    public function status(): ?Status
    {
        if($this->status_id){
            return ((new Status())->findById($this->status_id));
        }
        return null;
    }

    public function product(): ?Products
    {
        if($this->product_id){
            return ((new Products())->findById($this->product_id));
        }
        return null;
    }
}