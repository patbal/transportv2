<?php

namespace App\Form;

use App\Entity\Couleur;
use App\Entity\CouleurComplete;
use App\Entity\Teinte;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CouleurCompleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCouleurComplete')
            ->add('couleur', EntityType::class, array(
                'class' => Couleur::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nomCouleur', 'ASC');},
                'choice_label' => 'nomCouleur',
                'choice_value' => 'nomCouleur',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('teinte', EntityType::class, array(
                'class' => Teinte::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.teinte', 'ASC');},
                'choice_label' => 'teinte',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('save',            submitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CouleurComplete::class,
        ]);
    }
}
