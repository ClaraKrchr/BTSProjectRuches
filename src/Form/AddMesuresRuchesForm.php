<?php

namespace App\Form;

use App\Entity\MesuresRuches;
use App\Entity\CRuche;
use App\Entity\CPeseRuche;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;

class AddMesuresRuchesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('ruche',EntityType::class, [
            'class'=>CRuche::class,
            'choice_label'=>function(CRuche $CRuche){
            return sprintf(' %s',$CRuche->getNomruche());
            }
            ])
            ->add('datereleve', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('poids',RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 50
                ]])
                ->add('peseruche',EntityType::class, [
                    'class'=>CPeseRuche::class,
                    'choice_label'=>function(CPeseRuche $CPeseRuche){
                    return sprintf(' %s',$CPeseRuche->getNomPeseRuche());
                    }
                    ])
        ;
    }
}
