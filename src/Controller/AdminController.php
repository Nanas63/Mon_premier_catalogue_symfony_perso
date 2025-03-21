<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]
final class AdminController extends AbstractController
{
    #[Route('', name: 'app_admin')]
    //#[IsGranted ("ROLE_ADMIN")]
    public function index(): Response

    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/list_category', name: 'list_category')]
    public function listcategory(CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response


    {
        $categories = $categoryRepository->findAll();



        return $this->render('admin/category.html.twig', [
            'categories' => $categories,
        ]);
    }


    /* #[Route('/edit_product.category/{id}', name: 'edit_product.category')]
    public function editproductcategory($id,ProductRepository $productRepository, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response

    {

        $category= $categoryRepository->find($id);

        $category->setLabel('toto');

        $entityManager->persist($category);
        $entityManager->flush();
    } */


    #[Route('/show_category/{id}', name: 'show_category')]
    public function showcategory($id, CategoryRepository $categoryRepository): Response


    {
        $category = $categoryRepository->find($id);

        return $this->render('/admin/item.html.twig', [
            'category' => $category,

        ]);
    }



    #[Route('/add_category', name: 'add_category')]
    public function addcategory(EntityManagerInterface $entityManager, Request $request): Response

   
    {

    $category = new Category ();


    $form = $this-> createForm(CategoryType::class, $category);

    $form ->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){

        $entityManager->persist($category);
        $entityManager->flush();
    }

    
        return $this->render('/admin/add.html.twig', [
            'controller_name' => 'AdminController',

            'form' => $form->createView(),
        ]);
    }

   

    #[Route('/remove_category/{id}', name: 'remove_category')]
    public function removecategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response

    {

        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin/show_category');
    }

    #[Route('/edit_category/{id}', name: 'edit_category')]
    public function editcategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response


    {
        $category = $categoryRepository->find($id);


        
        $category->setLabel('PAINS');

        $entityManager->persist($category);
        $entityManager->flush(); 
            return $this->render('admin/edit.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        
    }
}
