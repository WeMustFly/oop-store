<?php

namespace OOPStore;

interface CategoryInterface
{
    public function __construct($name);  // : ???????
    public function setName($name): string;
    public function getName(): string;
}