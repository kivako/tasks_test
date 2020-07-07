<?php
namespace Core;

class AbstractController
{
    public function renderView($viewName, array $arg = null)
    {
        if (!empty($arg)) extract($arg);

        ob_start();
        include( "protected/views/{$viewName}.php");
        $content = ob_get_clean();

        require "protected/layout_main.php";
    }
}