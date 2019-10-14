<?php

namespace App\Form;

use App\Entity\Couleur;
use App\Entity\Nuance;
use App\Entity\Teintes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NuanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('couleur', entityType::class, array(
                'class' => Couleur::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nomCouleur', 'ASC');},
                'choice_label' => 'nomCouleur',
                'choice_value' => 'nomCouleur',
                'placeholder' => '---',
                'multiple' => false,
                'expanded' => false
            ))

        ;

        $formModifier = function (FormInterface $form, Couleur $couleur = null) {
            $teintes = null === $couleur ? [] : $couleur->getTeintes();

            $form->add('teinte', EntityType::class, [
                'class' => Teintes::class,
                'placeholder' => 'select nuance',
                'choices' => $teintes,
                'choice_label' => 'nomTeinte',
                'choice_value' => 'nomTeinte',
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

        $builder->add('save',            submitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nuance::class,
        ]);
    }
}
