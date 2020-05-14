<?php

namespace App\Form;

use App\Entity\MesuresStations;
use App\Entity\CRucher;
use App\Entity\CStation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class AddMesuresStationsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('station',EntityType::class, [
            'class'=>CStation::class,
            'choice_label'=>function(CStation $CStation){
            return sprintf(' %s',$CStation->getNom());
            }
            ])
            ->add('temperature')
            ->add('tension')
            ->add('humidite')
            ->add('pression')
            ->add('datereleve', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('rucher',EntityType::class, [
                'class'=>CRucher::class,
                'choice_label'=>function(CRucher $CRucher){
                return sprintf(' %s',$CRucher->getNom());
                    }
                    ])
        ;
    }
}
