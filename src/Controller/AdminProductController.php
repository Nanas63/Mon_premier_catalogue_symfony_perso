<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/product')]
final class AdminProductController extends AbstractController
{

    #[Route('/list_product', name: 'list_product')]
    public function listproduct(ProductRepository $productRepository, EntityManagerInterface $entityManager): Response


    {
        $products = $productRepository->findAll();



        return $this->render('admin_product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/show_product/{id}', name: 'show_product')]
    public function showproduct($id, ProductRepository $productRepository): Response


    {
        $product = $productRepository->find($id);

        return $this->render('/admin_product/showproduct.html.twig', [
            'product' => $product,

        ]);
    }


    #[Route('/add_product', name: 'add_product')]
    public function addproduct(EntityManagerInterface $entityManager, Request $request): Response


    {

        $product = new Product();


        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($product);
            $entityManager->flush();
        }


        return $this->render('/admin_product/addproduct.html.twig', [
            'controller_name' => 'AdminController',

            'form' => $form->createView(),
        ]);
    }



    #[Route('/remove_product/{id}', name: 'remove_product')]
    public function removecategory($id, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response

    {

        $product = $productRepository->find($id);

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('list_product');
    }


    #[Route('/edit_product/{id}', name: 'edit_product')]
    public function editproduct($id, ProductRepository $productRepository, EntityManagerInterface $entityManager, Request $request): Response


    {
        $product = $productRepository->find($id);
        

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($product);
            $entityManager->flush();
        }


        /* $product = $productRepository->find($id);
        $product->setLabel('');

        $entityManager->persist($product);
        $entityManager->flush(); { */

             return $this->render('admin_product/editproduct.html.twig', [
                'form'=>$form->createView()
            ]);
    }
}
