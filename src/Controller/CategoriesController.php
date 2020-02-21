<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/administration/categories")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="categories")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categories::class)->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/ajouter", name="ajouter_categorie")
     */
    public function ajoutCategories(Request $request)
    {
        $categories = new Categories();

        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file= $etd-> getPoster();
            $fileName = md5(uniqueid()).'.'.$file->guessExtension();
            $file-> move(
             $this-> getParameter("brochure_Directory")

              );
            $etd-> setPoster($fileName);


            $em->persist($categories);
            $em->flush();
            return $this->redirectToRoute("categories");
        }
        return $this->render("categories/add.html.twig", [
            'form' => $form->createview(),
            'titre' => 'Ajouter une nouvelle Categories'
        ]);
    }


    /**
     * @Route("/modifier/{id}", name="modifier_categorie")
     */
    public function modifierCategories(Request $request, Categories $categories)
    {
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories);
            $em->flush();
            return $this->redirectToRoute("categories");
        }
        return $this->render("categories/edit.html.twig", [
            'form' => $form->createview(),
            'titre' => 'Modifier une nouvelle Categories'
        ]);
    }
    
    /**
     * @Route("/supp/{id}", name="supprimer_categorie")
     */
    public function supprimer(Categories $categories)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categories);
        $em->flush();
        return $this->redirectToRoute("categories");
    }






}
