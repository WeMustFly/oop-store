<?php

define('CLASSES_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'classes');
define('CUSTOMERS_FILE', 'customers.txt');

$d = dir(CLASSES_DIR);
while (false !== ($classFile = $d->read())) {
    if ($classFile === '.' || $classFile === '..') {
        continue;
    }
    require_once(CLASSES_DIR . DIRECTORY_SEPARATOR . $classFile);
}

session_start();

$vars['{LOGIN_ERROR}'] = '';
$vars['{REGISTER_ERROR}'] = '';

if (empty($_SESSION)) {
    if ($_GET['app'] === 'login') {
        $email = $_POST['email'] ?? 'default';
        $password = $_POST['password'] ?? 'default';
        $auth = new \OOPStore\Auth();
        $customerAuth = new \OOPStore\Customer('', '', $email, $password);

        $customer = $auth->login($customerAuth);
        
        if ($customer !== false) {
            $_SESSION['firstName'] = $customer->getFirstName();
            $_SESSION['lastName'] = $customer->getLastName();
            $_SESSION['email'] = $customer->getEmail();
            $template = 'dashboard';
        } else {
            $template = 'forms';
            $vars['{LOGIN_ERROR}'] = 'Incorrect E-Mail or Password';
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
            $_SESSION['firstName'] = $customer->getFirstName();
            $_SESSION['lastName'] = $customer->getLastName();
            $_SESSION['email'] = $customer->getEmail();
            $template = 'dashboard';
        } else {
            $template = 'forms';
            $vars['{REGISTER_ERROR}'] = 'This email is already in use';
        }
    }

    if (empty($_GET['app'])) {
        $template = 'forms';
    }
} else {
    $template = 'dashboard';
    
    if ($_GET['app'] === 'logout') {
        session_destroy();
        $template = 'forms';
    }
}

$vars['{FIRST_NAME}'] = $_SESSION['firstName'];
$vars['{LAST_NAME}'] = $_SESSION['lastName'];
$vars['{EMAIL}'] = $_SESSION['email'];

$view = new \OOPStore\Output();
$view->OutputHTML($vars, $template);
