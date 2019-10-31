<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Transport;
use App\Entity\Vehicule;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroLocasyst')
            ->add('description')
            ->add('datePickup', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('pickupTime', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'choice',
            ])
            ->add('dateDelivery', DateType::class, array(
                'widget' => 'single_text'
            ))
            ->add('deliveryTime', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'single_text',

            ])
            ->add('typeVehicule',   EntityType::class, array(
                'class'        => Vehicule::class,
                'choice_label' => 'typevehicule',
                'multiple'     => false,
                'expanded'     => false))
            ->add('expediteur', entityType::class, array(
                'class' => Adresse::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');},
                'choice_label' => 'nom',
                'choice_value' => 'nom',
                'placeholder' => 'Selectionnez l\'adresse d\'enlèvement',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('destinataire', entityType::class, array(
                'class' => Adresse::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');},
                'choice_label' => 'nom',
                'choice_value' => 'nom',
                'placeholder' => 'Selectionnez l\'adresse de livraison',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('nombreColis')
            ->add('nombreMetresPlancher')
            ->add('nombrePalettes')
            ->add('remarque')
            ->add('save', submitType::class)
        ;

        $formModifier1 = function (FormInterface $form, Adresse $expediteur = null) {
            $contactsExp = null === $expediteur ? [] : $expediteur->getContacts();
            $form->add('contactExpediteur', EntityType::class, [
                'class' => Contact::class,
                'placeholder' => '---',
                'choices' => $contactsExp,
                'choice_label' => 'nom',
                'choice_value' => 'nom',
                'required' => false
            ]);
        };

        $formModifier2 = function (FormInterface $form, Adresse $destinataire = null) {
            $contactsDest = null === $destinataire ? [] : $destinataire->getContacts();
            $form->add('contactDestinataire', EntityType::class, [
                'class' => Contact::class,
                'placeholder' => '---',
                'choices' => $contactsDest,
                'choice_label' => 'nom',
                'choice_value' => 'nom',
                'required' => false
            ]);
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier1, $formModifier2) {

            $transport = $event->getData(); // On récupère notre objet sous-jacent
            if ($transport->getTypeDemande() === null || !$transport)
            {
                return; // On sort de la fonction sans rien faire lorsque $advert vaut null
            }

            $type = $transport->getTypeDemande();

            $formModifier1($event->getForm(), $transport->getExpediteur());
            $formModifier2($event->getForm(), $transport->getDestinataire());

            if($type == 'course')
            {
                $event->getForm()->remove('nombrePalettes');
                $event->getForm()->remove('nombreMetresPlancher');
                $event->getForm()->remove('nombreColis');
            }

            if($type == 'transport')
            {
                $event->getForm()->remove('pickupTime');
                $event->getForm()->remove('deliveryTime');
                $event->getForm()->remove('typeVehicule');
            }

            if($type == 'location')
            {
                $event->getForm()->remove('nombrePalettes');
                $event->getForm()->remove('nombreMetresPlancher');
                $event->getForm()->remove('nombreColis');
                $event->getForm()->remove('expediteur');
                $event->getForm()->remove('destinataire');
                $event->getForm()->remove('contactExpediteur');
                $event->getForm()->remove('contactDestinataire');
            }

                //$data = $event->getData();

            }

        );

        $builder->get('expediteur')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier1) {
                $expediteur = $event->getForm()->getData();
                $formModifier1($event->getForm()->getParent(), $expediteur);
            }
        );
        $builder->get('destinataire')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier2) {
                $destinataire = $event->getForm()->getData();
                $formModifier2($event->getForm()->getParent(), $destinataire);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
