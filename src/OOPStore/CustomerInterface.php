<?php

namespace OOPStore;

interface CustomerInterface
{
    public function __construct($firstName, $lastName);  // : ???????
    public function getFirstName(): string;
    public function getLastName(): string;
}