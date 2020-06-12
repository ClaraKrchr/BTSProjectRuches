<?php

namespace App\Form;

use App\Entity\MesuresRuches;
use App\Entity\CRuche;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Doctrine\ORM\EntityRepository;

class AddMesuresRuchesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('ruche',EntityType::class, [
            'class'=>CRuche::class,
            'query_builder' => function(EntityRepository $er){
            return $er->createQueryBuilder('u')->select('w')->from(CRuche::class, 'w')->orderBy('w.nomruche', 'ASC');
            },
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
        ;
    }
}
