<?php

namespace OOPStore;

interface ProductInterface
{
    public function getId(): int;
    public function getPrice(): float;
    public function getCategory(): Category;
}
