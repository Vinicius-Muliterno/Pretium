<?php

namespace Source\Models;

class MeasurementUnits extends \CoffeeCode\DataLayer\DataLayer
{
    public function __construct()
    {
        parent::__construct("measurement_units", ["unity", "symbol"], "id",false);
    }
}