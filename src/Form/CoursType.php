<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\File;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre', TextType::class, ["label" => "Le Titre de Cours :"])
            ->add('Auteur', TextType::class, ["label" => "Présenter par :"])
            ->add('date', DateTimeType::class, ["label" => "Date debut de cours :"])
            ->add('description', TextareaType::class, ["label" => "Description :"])
            ->add('poster', FileType::class, ['label' => 'Poster(pdf file)',

                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',

                        ],

                    ])
                ],



            ])
            ->add('categories', EntityType::class, [
                "class"=> "App\Entity\Categories",
                "label"=> "Choisir une catégories",
                "choice_label"=>"nom"
            ])
            ->add("Valider", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
