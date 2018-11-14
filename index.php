<?php

\spl_autoload_register(function ($class) {
    $classFilename = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR
        . \str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    require $classFilename;
});

$category = new \OOPStore\Category('TV');
$product1 = new \OOPStore\Product($category, 'LG LX35', 1000000);
$product2 = new \OOPStore\Product($category, 'LG LX35', 1000000);
$store = new \OOPStore\Store();
$customer = new \OOPStore\Customer('Ivan', 'Ivanovich');
$cart = new \OOPStore\Models\Cart($customer);

foreach ([$product1, $product1, $product2] as $product) {
    try {
        $store->addProduct($product);
    } catch (\OOPStore\StoreException $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}

$store->removeProduct($product1);
$cart->addProduct($product1);

try {
    $store->removeProduct($product1);
} catch (\OOPStore\StoreException $e) {
    echo $e->getMessage() . PHP_EOL;
}

print_r($store->getProducts());
print_r($cart->getTotal());
