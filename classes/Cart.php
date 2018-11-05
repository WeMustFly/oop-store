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
    
    public function delProduct(Product $product)  // removes one unit of product
    {
        foreach ($this->products as $key => $value) {
            if ($value->getName() == $product->getName()) {
                unset($this->products[$key]);
                return;
            }
        }
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
}
