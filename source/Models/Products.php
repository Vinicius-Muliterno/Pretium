<?php

namespace Source\Models;

class Products extends \CoffeeCode\DataLayer\DataLayer
{
    public function __construct()
    {
        parent::__construct("products", ["product_name", "brand", "code", "provider_id", "measurement_units_id"]);
    }

    public function measurementUnit(): ?MeasurementUnits
    {
        if($this->measurement_units_id){
            return ((new MeasurementUnits())->findById($this->measurement_units_id));
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
}