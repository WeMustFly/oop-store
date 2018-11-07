<?php

namespace OOPStore;

class Output
{
    private $vars = [];

    public function outputHTML($template)
    {
        $html = file_get_contents('templates' . DIRECTORY_SEPARATOR . $template . '.html');
        echo str_replace(
            array_keys($this->$vars),
            array_values($this->$vars),
            $html
        );
    }

    public function setVars($key, $value)
    {
        $this->$vars[$key] = $value;
    }

    public function getVars()
    {
        return $this->vars;
    }

    public function makeHtmlCart(Cart $cart)
    {
        $products = $cart->getProducts();
        $htmlCart = null;

        foreach ($products as $productIndex => $product) {
            $category = $product->getCategory();
            $htmlCart .= '<tr><td>' . $category->getName() . '</td><td>' . $product->getName() . '</td>';
            $htmlCart .= '<td>' . $product->getPrice() . '</td>';
            $htmlCart .= '<td><a href="/?app=removeProduct&productId='. $productIndex .'">Remove</a></td><tr>';
        }

        return $htmlCart;
    }
}
