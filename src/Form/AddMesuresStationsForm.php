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
use Doctrine\ORM\EntityRepository;

class AddMesuresStationsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('temperature')
            ->add('tension')
            ->add('humidite')
            ->add('pression')
            ->add('datereleve', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('rucher',EntityType::class, [
                'class'=>CRucher::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->select('w')->from(CRucher::class, 'w')->orderBy('w.nom', 'ASC');
                },
                'choice_label'=>function(CRucher $CRucher){
                return sprintf(' %s',$CRucher->getNom());
                    }
                    ])
        ;
    }
}
