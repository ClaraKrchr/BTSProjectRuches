<?php

namespace App\Form;

use App\Entity\CPeseRuche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AddPeseRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nompeseruche')
            ->add('dateinstall', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('associationPeserucheStation')
            ->add('associationRuchePeseruche')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CPeseRuche::class,
        ]);
    }
}
