<?php

namespace OOPStore;

class Product implements ProductInterface
{
    private $id;
//    private $category;
    private $name;
    private $price;

    private static $lastID = 0;

    public function __construct(Category $category, $name, $price)  // : ???????
    {
        $this->id = ++self::$lastID;
        $this->category = $category;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setPrice($price): float
    {
        if ($price > 0) {
            $this->price = $price;
        }
    }

    public function getPrice(): float
    {
        return $this->price;
    }

 //   public function getCategory(): string
 //   {
 //       return $this->category;
 //   }

}
