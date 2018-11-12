<?php

use OOPStore\Category;
use OOPStore\Product;
use OOPStore\Store;

\spl_autoload_register(function ($class) {
    $classFilename = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR
        . \str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    require $classFilename;
});

$category = new Category('TV');
$product1 = new Product($category, 'LG LX35', 1000000);
$product2 = new Product($category, 'LG LX35', 1000000);
$store = new Store();

$store->addProduct($product1);
$store->addProduct($product1);
$store->addProduct($product2);

$store->removeProduct($product1);

print_r($store->getProducts());
