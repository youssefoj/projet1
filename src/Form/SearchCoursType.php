<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre', ChoiceType::class,[
              'choice'=>
                      array_combine(CoursProvider::AUTEUR, CoursProvider::AUTEUR)
            ])
            ->add('Auteur')
            ->add('date')
            ->add('description')
            ->add('poster')
            ->add('titre')
            ->add('Categories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
