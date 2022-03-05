<?php

namespace Source\Models;

class QuoteProduct extends \CoffeeCode\DataLayer\DataLayer
{
    public function __construct()
    {
        parent::__construct("quotes_products", ["quote_id", "product_id", "qtd"]);
    }

    public function product(): ?Products
    {
        if($this->product_id){
            return ((new Products())->findById($this->product_id));
        }
        return null;
    }
}