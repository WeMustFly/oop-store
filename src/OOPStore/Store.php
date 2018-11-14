<?php

namespace OOPStore;

class Store implements StoreInterface
{
    private $products = [];

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(Product $product): void 
    {
        if ($this->hasProduct($product)) {
            throw new StoreException('Duplicate product');
        }

        $this->products[$product->getId()] = $product;
    }

    public function removeProduct(Product $product): void
    {
        if (!$this->hasProduct($product)) {
            throw new StoreException('Product not found');
        }

        unset($this->products[$product->getId()]);
    }

    public function hasProduct(Product $product): bool
    {
        return isset($this->products[$product->getId()]);
    }
}
