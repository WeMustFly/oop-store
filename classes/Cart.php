<?php

namespace OOPStore;

class Cart
{
    private $customer;
    private $products;
    private $purchase;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        $this->products = [];
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function addProduct(Product $product)
    {
        if (empty($this->purchase)) {
            $this->products[] = $product;
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getTotal()
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

    public function removeProduct(Product $product)
    {
        $removedProductKey = array_search($product, $this->products);
        if ($removedProductKey) {
            unset($this->products[$removedProductKey]);
        }
    }
}
