<?php

define('CLASSES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'classes');
define('CUSTOMERS_FILE', 'customers.txt');

spl_autoload_register(function ($class) {
    $className = explode('\\', $class);
    require_once(CLASSES_DIR . DIRECTORY_SEPARATOR . end($className) . '.php');
});

$emailPost = $_POST['email'] ?? 'default';
$passwordPost = $_POST['password'] ?? 'default';
$firstNamePost = $_POST['firstName'] ?? 'default';
$lastNamePost = $_POST['lastName'] ?? 'default';
$app = $_GET['app'] ?? '';

session_start();
$view = new \OOPStore\Output();

if (empty($_SESSION)) {
    if ($app === 'login') {
        $auth = new \OOPStore\Auth();
        $customerAuth = new \OOPStore\Customer('', '', $emailPost, $passwordPost);

        $customer = $auth->login($customerAuth);
        
        if ($customer !== false) {
            $_SESSION['customer'] = serialize($customer);
            $template = 'dashboard';
        } else {
            $template = 'forms';
            $view->setVars('{LOGIN_ERROR}', 'Incorrect E-Mail or Password');
        }
    }

    if ($app === 'register') {
        $auth = new \OOPStore\Auth();
        $customerRegister = new \OOPStore\Customer($firstNamePost, $lastNamePost, $emailPost, $passwordPost);

        $customer = $auth->register($customerRegister);
        
        if ($customer !== false) {
            $_SESSION['customer'] =  serialize($customer);
            $template = 'dashboard';
        } else {
            $template = 'forms';
            $view->setVars('{REGISTER_ERROR}', 'This email is already in use');
        }
    }

    if (empty($app)) {
        $template = 'forms';
    }
} else {
    $template = 'dashboard';
    $customer = unserialize($_SESSION['customer']);

    if (empty($_SESSION['cart'])) {
        $cart = new \OOPStore\Cart($customer);
        $_SESSION['cart'] = serialize($cart);
    } else {
        $cart = unserialize($_SESSION['cart']);
    }

    if ($app === 'logout') {
        session_destroy();
        $template = 'forms';
    }

    if ($app === 'addProduct') {
        $category = new \OOPStore\Category('TV');
        $price = rand(1000, 5000);
        $tvModel = rand(10, 70);
        $product = new \OOPStore\Product($category, 'LG ' . $tvModel, $price);
        $cart->addProduct($product);
        $_SESSION['cart'] = serialize($cart);
    }

    if ($app === 'removeProduct') {
        $productIndex = $_GET['productId'] ?? 0;

        $products = $cart->getProducts();
        if (in_array($products[$productIndex], $products)) {
            $cart->removeProduct($products[$productIndex]);
        }
    
        $_SESSION['cart'] = serialize($cart);
    }
}

if (isset($customer) && $customer !== false) {
    $view->setVars('{FIRST_NAME}', $customer->getFirstName());
    $view->setVars('{LAST_NAME}', $customer->getLastName());
    $view->setVars('{EMAIL}', $customer->getEmail());
}

if (isset($cart)) {
    $view->setVars('{CART_TABLE}', $view->makeHtmlCart($cart));
    $view->setVars('{CART_TOTAL}', $cart->getTotal());
}

$view->OutputHTML($template);
