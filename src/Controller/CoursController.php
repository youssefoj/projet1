<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Entity\Cours;
use App\Form\CoursType;
use App\Form\CategoriesType;
use App\Repository\CategoriesRepository;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\File;






class CoursController extends AbstractController
{
    /**
     *  @Route("/cours/new", name="cour_create")
     * @Route("/cours/{id}/edit", name="cour_edit")
     */
    public function create(Cours $Cour=null, Request $request)
    {
       $cour = new Cours();
       //on creer un cour
       if(!$cour){
          	$cour = new Cours();
       }


    	//on récupère le formulaire
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        //si le formulaire a été soumis
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */


            $posterFile = $form->get('poster')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($posterFile) {
                $originalFilename = pathinfo($posterFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $posterFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $posterFile->setBrochureFilename($newFilename);
            }












            if ($cour->getId()){
             $cour->setCeatedAt(new \DateTime());
           }

            $file=new File ($form->gePoster());
         // on enregistre le cours en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($cour);
            $em->flush();

            return $this->redirectToRoute('cours_show',['id'=> $cour.getId()]);
        }

        return $this->render('cours/create.html.twig', [
             // On genère le Html de formulaire créer
            'formCour' => $form->createview(),
            'editMode' => $cour->getId() !== null
          
        ]);

    }

   /**
     * @Route("/recherchecours/{id}", name="findcours")
     */
    public function recherche(Cours $c)
    {
        return $this->render('cours/recherche.html.twig', [
            'cours' => $c,
        ]);
    }


 /**
     * @Route("/allcours", name="cours")
   */
    public function affiche_tout(CoursRepository $repository)
    {
        $cours = $repository->findAll();
        return $this->render('cours/affichage.html.twig', [
            'cours' => $cours,
        ]);
    }




    /**
     * @Route("/modifier/{id}", name="modifier_cours")
     */
    public function modifierCours(Request $request, Categories $cours)
    {
        $form = $this->createForm(CategoriesType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute("cours");
        }
        return $this->render("cours/edit.html.twig", [
            'form' => $form->createview(),
            'titre' => 'Modifier un nouvelle cours'
        ]);
    }







    /**
     * @Route("/supp/{id}", name="sup_cours")
     */
    public function supprimer(Cours $cours)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($cours);
        $em->flush();
        return $this->redirectToRoute("cours");
    }
}
