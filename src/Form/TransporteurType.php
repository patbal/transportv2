<?php

namespace App\Form;

use App\Entity\Transporteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransporteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse1')
            ->add('adresse2')
            ->add('codepostal')
            ->add('ville')
            ->add('telephone')
            ->add('email')
            ->add('coursier', CheckboxType::class, [
                'empty_data' => null,
                'required' => false])
            ->add('transporteur', CheckboxType::class, [
                'empty_data' => null,
                'required' => false])
            ->add('loueur', CheckboxType::class, [
                'empty_data' => null,
                'required' => false])
            ->add('sauvegarder',submitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Transporteur::class,
        ]);
    }
}
