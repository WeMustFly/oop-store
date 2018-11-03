<?php

namespace OOPStore;

class Product
{
    private $category;
    private $name;
    private $price;

    public function __construct(Category $category, $name, $price)
    {
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
    }

    public function setPrice($price)
    {
        if ($price > 0) {
            $this->price = $price;
        }
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCategory()
    {
        return $this->category;
    }

}