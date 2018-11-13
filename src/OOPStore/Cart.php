<?php

namespace OOPStore;

class Cart implements CartInterface
{
    private $customer;
    private $products;
    private $purchase;

    public function __construct(Customer $customer) // : ???????
    {
        $this->customer = $customer;
        $this->products = [];
    }

    public function getCustomer(): Customer  // or Cart
    {
        return $this->customer;
    }

    public function addProduct(Product $product)  // : ???????
    {
        if (empty($this->purchase)) {
            $this->products[] = $product;
        }
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->getPrice();
        }

        return $total;
    }

    public function createPurchase(): Purchase
    {
        $this->purchase = new Purchase($this);
        return $this->purchase;
    }
}
