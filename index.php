<?php

define('CLASSES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'classes');

//require_once(CLASSES_DIR . '/Category.php'); 

// http://php.net/manual/en/function.dir.php
$d = dir(CLASSES_DIR);
while (false !== ($classFile = $d->read())) {
    if ($classFile === '.' || $classFile === '..') {
        continue;
    }
    require_once(CLASSES_DIR . DIRECTORY_SEPARATOR . $classFile); 
}

$category = new \OOPStore\Category('TV');
$product = new \OOPStore\Product($category, 'LG LX35', 1000000);
$customer = new \OOPStore\Customer('Oleg', 'Lobanov');
$cart = new \OOPStore\Cart($customer);

$cart->addProduct($product);
$cart->addProduct($product);

echo "Total: ";
var_dump($cart->getTotal());

$purchase = $cart->createPurchase();

$cart->addProduct($product);

echo "Total: ";
var_dump($cart->getTotal());
