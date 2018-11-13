<?php

namespace OOPStore;

interface ProductInterface
{
    public function __construct(Category $category, $name, $price); // : ???????
    public function getId(): int;
    public function setPrice($price): float;
    public function getPrice(): float;
//    public function getCategory(): string;
}