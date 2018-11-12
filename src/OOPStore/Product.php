<?php

namespace OOPStore;

class Product
{
    private $id;
    private $category;
    private $name;
    private $price;

    static private $lastID = 0;

    public function __construct(Category $category, $name, $price)
    {
        $this->id = ++self::$lastID;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
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