<?php

namespace App\Form;

use App\Entity\CPeseRuche;
use App\Entity\CStation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddPeseRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nompeseruche')
            ->add('dateinstall', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('visibilite',ChoiceType::class,
                array(
                    'choices'=>array(
                        'Publique'=>'0',
                        'Privee'=>'1',
                    ),
                    'expanded'=>true,
                    'multiple'=>false
                ))                
             ->add('nomstation',EntityType::class, [
                'class'=>CStation::class,
                'choice_label'=>function(CStation $CStation){
                return sprintf(' %s',$CStation->getNom());
                }
                ])   
        ;
    }
}
