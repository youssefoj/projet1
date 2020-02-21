<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends AbstractController
{
    /**
     * @Route("/cours/search", name="search-cours")
     */


    public function searchCours(Request $request){
        $form = $this-> createFormBuilder(null)
            ->add('query', TextType::class)
            ->add('search',SubmitType::class, [
                'attr'=>[
                 'class'=> 'btn btn-primary'
                ]

            ])
        -> getForm();

       return $this->render( 'cours/affichage.html.twig',[
           'form'=>$form->createView()
       ]);
    }


}
