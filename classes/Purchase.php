<?php

namespace OOPStore;

class Purchase
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
}
