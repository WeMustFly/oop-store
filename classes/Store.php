<?php

namespace OOPStore;

class Store implements StoreInterface
{
    private $products = [];

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(Product $product): bool
    {
        if ($this->hasProduct($product)) {
            return false;
        }

        $this->products[$product->getId()] = $product;
        return true;
    }

    public function removeProduct(Product $product): bool
    {
        if ($this->hasProduct($product)) {
            unset($this->products[$product->getId()]);
            return true;
        }

        return false;
    }

    public function hasProduct(Product $product): bool
    {
        return isset($this->products[$product->getId()]);
    }
}
