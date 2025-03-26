<?php

namespace App\Twig\Runtime;

use App\Repository\CategoryRepository;
use Twig\Extension\RuntimeExtensionInterface;

class AffichageRuntime implements RuntimeExtensionInterface
{
    public function __construct(
    
        private CategoryRepository $categoryRepository)
    {
        // Inject dependencies if needed
    }


    public function showprice($value)
    {
        return number_format($value, 2, ',', ' ') . ' €';

    }


    public function showcategory():array
    {
        $categories = $this->categoryRepository->findAll();
        return $categories;
        // ...
    }


    
}
