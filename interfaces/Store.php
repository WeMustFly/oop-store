<?php

namespace OOPStore;

interface StoreInterface
{
    public function getProducts(): array;
    public function addProduct(Product $product): bool;
    public function removeProduct(Product $product): bool;
    public function hasProduct(Product $product): bool;
}
