<?php

namespace OOPStore;

interface CartInterface
{
    public function __construct(Customer $customer);  // : ???????
    public function getCustomer(): Customer;  // or Cart
    public function addProduct(Product $product); // : ???????
    public function getTotal(): float;
    public function createPurchase(): Purchase;
}