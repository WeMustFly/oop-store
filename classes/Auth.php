<?php

namespace OOPStore;

class Auth
{
    private function getAllCustomers()
    {
        if (!file_exists(CUSTOMERS_FILE)) {
            file_put_contents(CUSTOMERS_FILE, serialize([]));
        }
        return unserialize(file_get_contents(CUSTOMERS_FILE));
    }

    private function saveAllCustomers($customers)
    {
        file_put_contents(CUSTOMERS_FILE, serialize($customers));
    }

    public function register(Customer $customerRegister)
    {
        $customers = $this->getAllCustomers();
        $emailRegister = $customerRegister->getEmail();

        foreach ($customers as $customer) {
            $email = $customer->getEmail();

            if ($emailRegister === $email) {
                return false;
            }
        }

        $customers[] = $customerRegister;
        $this->saveAllCustomers($customers);
        return $customerRegister;
    }

    public function login(Customer $customerAuth)
    {
        $customers = $this->getAllCustomers();

        $emailAuth = $customerAuth->getEmail();
        $passwordAuth = $customerAuth->getPassword();

        foreach ($customers as $customer) {
            $email = $customer->getEmail();
            $password = $customer->getPassword();

            if ($emailAuth === $email && $passwordAuth === $password) {
                return $customer;
            }
        }
        return false;
    }
}
