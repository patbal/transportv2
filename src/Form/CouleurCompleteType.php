<?php

namespace App\Form;

use App\Entity\Couleur;
use App\Entity\CouleurComplete;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
            /*->add('teinte', EntityType::class, array(
                'class' => Teinte::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.teinte', 'ASC');},
                'choice_label' => 'teinte',
                'multiple' => false,
                'expanded' => false
            ))*/
            ->add('save',            submitType::class);
        ;

        $formModifier = function (FormInterface $form, Couleur $couleur = null) {
            if ($couleur === null) {
                $teintes = [];
            } else {
                $color = $couleur -> getNomCouleur();
                $teintes = function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->andWhere('e.couleur = :val')
                        ->setParameter('val', $color)
                        ->orderBy('e.id', 'ASC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult();
                };
            }

            $form->add('teinte', EntityType::class, [
                'class' => couleur::class,
                'placeholder' => '',
                'choices' => $teintes,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getCouleur());
            }
        );

        $builder->get('couleur')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $couleur = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $couleur);
            }
        );






    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CouleurComplete::class,
        ]);
    }
}
