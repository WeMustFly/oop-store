<?php

namespace OOPStore;

class Output
{
    public function outputHTML($vars, $template)
    {
        $html = file_get_contents('templates' . DIRECTORY_SEPARATOR . $template . '.html');
        echo str_replace(
            array_keys($vars),
            array_values($vars),
            $html
        );
    }
}
