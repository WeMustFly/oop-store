<?php

namespace OOPStore;

interface StoreInterface
{
    public function getProducts(): array;
    public function addProduct(Product $product): void;
    public function removeProduct(Product $product): void;
    public function hasProduct(Product $product): bool;
}
