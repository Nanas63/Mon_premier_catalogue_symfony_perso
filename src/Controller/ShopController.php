<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/shop')]
final class ShopController extends AbstractController
{
    #[Route('', name: 'shop_index')]
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository): Response

    {
        
        $products = $productRepository->findAll();
        $categories = $categoryRepository->findAll ();

        return $this->render('shop/index.html.twig', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    #[Route('/product/{id}', name: 'shop_product')]
    public function product($id,ProductRepository $productRepository): Response
 
    {
        $product= $productRepository->find($id);

        return $this->render('shop/product.html.twig', [
            'product'=> $product,

        ]);
    }


    #[Route('/category/{id}', name: 'shop_category')]
    public function category($id, CategoryRepository $categoryRepository): Response

    {

        $categories = $categoryRepository->find($id);


        return $this->render('shop/category.html.twig', [
            'category' => $categories,
        ]);
    }
}
