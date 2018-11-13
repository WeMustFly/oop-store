<?php

use OOPStore\Cart;
use OOPStore\Category as CategoryOfProduct;
use OOPStore\Customer;
use OOPStore\Product;
use OOPStore\Store;
// use OOPStore\Purchase;

\spl_autoload_register(function ($class) {
    $classFilename = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR
    . \str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    require $classFilename;
});

$category = new CategoryOfProduct('TV');
$product1 = new Product($category, 'LG LX35', 1000000);
$product2 = new Product($category, 'SAMSUNG U40', 2000000);
$product3 = new Product($category, 'SONY P55', 2000000);

$store = new Store();

$store->addProduct($product1);
$store->addProduct($product1);
$store->addProduct($product2);
$store->addProduct($product3);

$store->removeProduct($product1);

print_r($store->getProducts());

///////////////////////////////////////////////////////////

$customer = new Customer('Oleg', 'Lobanov');
$cart = new Cart($customer);

$cart->addProduct($product1);
$cart->addProduct($product1);
$cart->addProduct($product2);
$cart->addProduct($product3);

echo "Total: ";
var_dump($cart->getTotal());

$purchase = $cart->createPurchase();

$cart->addProduct($product1);

echo "Total: ";
var_dump($cart->getTotal());
