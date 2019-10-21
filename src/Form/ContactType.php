<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Contact;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('mail')
            ->add('societe', entityType::class, array(
                'class' => Adresse::class,
                'query_builder' => function(entityRepository $er){
                    return $er -> createQueryBuilder('u')
                                -> orderBy('u.nom', 'ASC')
                ;},
                'choice_label' => 'nom',
                'choice_value' => 'id',
                'placeholder' => '---',
                'multiple' => false,
                'expanded' => false,
                'required' => false,
                'label' => 'société / site'
            ))
            ->add('sauvegarder',submitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
