<?php

define('CLASSES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'classes');
define('CUSTOMERS_FILE', 'customers.txt');

spl_autoload_register(function ($class) {
    $className = explode('\\', $class);
    require_once(CLASSES_DIR . DIRECTORY_SEPARATOR . end($className) . '.php');
});

session_start();
$view = new \OOPStore\Output();

$view->setVars('{LOGIN_ERROR}', '');
$view->setVars('{REGISTER_ERROR}', '');
$view->setVars('{CART_TABLE}', '');
$view->setVars('{CART_TOTAL}', '0');


if (empty($_SESSION)) {
    if ($_GET['app'] === 'login') {
        $email = $_POST['email'] ?? 'default';
        $password = $_POST['password'] ?? 'default';
        
        $auth = new \OOPStore\Auth();
        $customerAuth = new \OOPStore\Customer('', '', $email, $password);

        $customer = $auth->login($customerAuth);
        
        if ($customer !== false) {
            $_SESSION['customer'] = serialize($customer);
            $template = 'dashboard';
        } else {
            $template = 'forms';
            $view->setVars('{LOGIN_ERROR}', 'Incorrect E-Mail or Password');
        }
    }

    if ($_GET['app'] === 'register') {
        $email = $_POST['email'] ?? 'default';
        $password = $_POST['password'] ?? 'default';
        $firstName = $_POST['firstName'] ?? 'default';
        $lastName = $_POST['lastName'] ?? 'default';

        $auth = new \OOPStore\Auth();
        $customerRegister = new \OOPStore\Customer($firstName, $lastName, $email, $password);

        $customer = $auth->register($customerRegister);
        
        if ($customer !== false) {
            $_SESSION['customer'] =  serialize($customer);
            $template = 'dashboard';
        } else {
            $template = 'forms';
            $view->setVars('{REGISTER_ERROR}', 'This email is already in use');
        }
    }

    if (empty($_GET['app'])) {
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

    if ($_GET['app'] === 'logout') {
        session_destroy();
        $template = 'forms';
    }

    if ($_GET['app'] === 'addProduct') {
        $category = new \OOPStore\Category('TV');
        $price = rand(1000, 5000);
        $tvModel = rand(10, 70);
        $product = new \OOPStore\Product($category, 'LG ' . $tvModel, $price);
        $cart->addProduct($product);
        $_SESSION['cart'] = serialize($cart);
    }

    if ($_GET['app'] === 'removeProduct') {
        $productIndex = $_GET['productId'] ?? 0;

        $products = $cart->getProducts();
        if (in_array($products[$productIndex], $products)) {
            $cart->removeProduct($products[$productIndex]);
        }
    
        $_SESSION['cart'] = serialize($cart);
    }
}

if (isset($customer)) {
    $view->setVars('{FIRST_NAME}', $customer->getFirstName());
    $view->setVars('{LAST_NAME}', $customer->getLastName());
    $view->setVars('{EMAIL}', $customer->getEmail());
}

if (isset($cart)) {
    $view->setVars('{CART_TABLE}', $view->makeHtmlCart($cart));
    $view->setVars('{CART_TOTAL}', $cart->getTotal());
}

$view->OutputHTML($template);
