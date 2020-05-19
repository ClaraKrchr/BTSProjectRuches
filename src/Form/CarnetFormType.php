<?php

namespace App\Form;

use App\Entity\Carnet;
use App\Entity\CRuche;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CarnetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class, [
                'widget' => 'single_text',])
            ->add('commentaire')
            ->add('Ruche',EntityType::class, [
                'class'=>CRuche::class,
                'choice_label'=>function(CRuche $CRuche){
                return sprintf(' %s',$CRuche->getNomruche());
                },
                'required'=>true
                ])
            ->add('')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carnet::class,
        ]);
    }
}
