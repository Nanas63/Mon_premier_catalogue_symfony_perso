<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class DemoRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function doSomething(string $value) :string
    {

        return "!!!" . strtoupper($value) . "!!!";
        // ...
    }

    public function resulteuro(string $value) :string
    {

        return ($value) . "€";
        // ...
    }
    public function lenghttext(string $value) :string
    {

        return ($value) . "...";
        // ...
    }

}
