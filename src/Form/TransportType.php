<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Contact;
use App\Entity\Transport;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('datePickup')
            ->add('pickupTime', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
                'label' => 'Date d\'enlèvement'))
            ->add('dateDelivery')
            ->add('deliveryTime', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'js-datepicker'],
                'html5' => false,
                'label' => 'Date d\'enlèvement'))
            ->add('typeVehicule')
            ->add('expediteur', entityType::class, array(
                'class' => Adresse::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');},
                'choice_label' => 'nom',
                'choice_value' => 'nom',
                'placeholder' => '---',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('destinataire', entityType::class, array(
                'class' => Adresse::class,
                'query_builder' => function (EntityRepository $er) {return $er->createQueryBuilder('u')
                    ->orderBy('u.nom', 'ASC');},
                'choice_label' => 'nom',
                'choice_value' => 'nom',
                'placeholder' => '---',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('nombreColis')
            ->add('nombreMetresPlancher')
            ->add('nombrePalettes')
            ->add('remarque')
            ->add('save', submitType::class)
        ;

        $formModifier = function (FormInterface $form, Adresse $expediteur = null, Adresse $destinataire = null) {
            $contactsExp = null === $expediteur ? [] : $expediteur->getContacts();
            $contactsDest = null === $destinataire ? [] : $destinataire->getContacts();
            $form->add('contactExpediteur', EntityType::class, [
                'class' => Contact::class,
                'placeholder' => 'select contact',
                'choices' => $contactsExp,
                'choice_label' => 'nom',
                'choice_value' => 'nom',
            ]);
            $form->add('contactDestinataire', EntityType::class, [
                'class' => Contact::class,
                'placeholder' => 'select contact',
                'choices' => $contactsDest,
                'choice_label' => 'nom',
                'choice_value' => 'nom',
            ]);
        };

        //TODO ajouter les if pour gérer les champs courses loc ou transport
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getExpediteur(), $data->getDestinataire());

                $transport = $event->getData(); // On récupère notre objet sous-jacent
                if ($transport->getTypeDemande() === null || !$transport)
                {
                    return; // On sort de la fonction sans rien faire lorsque $advert vaut null
                }

                $type = $transport->getTypeDemande();

                if($type == 'Course')
                {
                    $event->getForm()->remove('nombrePalettes');
                    $event->getForm()->remove('nombreMetresPlancher');
                    $event->getForm()->remove('nombreColis');
                }

                if($type == 'Transport')
                {
                    $event->getForm()->remove('pickupTime');
                    $event->getForm()->remove('deliveryTime');
                    $event->getForm()->remove('typeVehicule');
                }

                if($type == 'Location')
                {
                    $event->getForm()->remove('nombrePalettes');
                    $event->getForm()->remove('nombreMetresPlancher');
                    $event->getForm()->remove('nombreColis');
                    $event->getForm()->remove('pickupTime');
                    $event->getForm()->remove('deliveryTime');
                    $event->getForm()->add('pickupTime', DateType::class, array(
                        'widget' => 'single_text',
                        'format' => 'dd/MM/yyyy',
                        'attr' => ['class' => 'js-datepicker'],
                        'html5' => false,
                        'label' => 'Date d\'enlèvement'));
                    $event->getForm()->add('deliveryTime', DateType::class, array(
                        'widget' => 'single_text',
                        'format' => 'dd/MM/yyyy',
                        'attr' => ['class' => 'js-datepicker'],
                        'html5' => false,
                        'label' => 'Date de restitution'));
                }
            }

        );

        $builder->get('expediteur')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $expediteur = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $expediteur);
            }
        );
        $builder->get('destinataire')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $destinataire = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $destinataire);
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
