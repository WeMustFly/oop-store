<?php

namespace OOPStore;

define('CLASSES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'classes');
define('INTERFACES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'interfaces');

function requireDir($dir)
{
    // http://php.net/manual/en/function.dir.php
    $d = dir($dir);
    while (false !== ($classFile = $d->read())) {
        if ($classFile === '.' || $classFile === '..') {
            continue;
        }
        require_once($dir . DIRECTORY_SEPARATOR . $classFile); 
    }
}

requireDir(INTERFACES_DIR);
requireDir(CLASSES_DIR);

$category = new Category('TV');
$product1 = new Product($category, 'LG LX35', 1000000);
$product2 = new Product($category, 'LG LX35', 1000000);
$store = new Store();

$store->addProduct($product1);
$store->addProduct($product1);
$store->addProduct($product2);

$store->removeProduct($product1);

print_r($store->getProducts());
