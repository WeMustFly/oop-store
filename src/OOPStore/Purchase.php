<?php

namespace OOPStore;

class Purchase implements PurchaseInterface
{
    private $cart;

    public function __construct(Cart $cart)  // : ???????
    {
        $this->cart = $cart;
    }
}
