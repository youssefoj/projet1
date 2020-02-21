<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;


class HomeController extends AbstractController
{
    /**
     * @Route("/cours", name="Lescours")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Cours::class);
        $cours=$repository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }






    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('home/home.html.twig');

    }



}
