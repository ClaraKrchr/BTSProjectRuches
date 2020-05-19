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
use Doctrine\ORM\EntityRepository;

class AddPeseRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nompeseruche')
            ->add('dateinstall', DateType::class, [
                'widget' => 'single_text',
                
            ])              
             ->add('nomstation',EntityType::class, [
                'class'=>CStation::class,
                 'query_builder' => function(EntityRepository $er){
                 return $er->createQueryBuilder('u')->select('w')->from(CStation::class, 'w')->orderBy('w.nom', 'ASC');
                 },
                'choice_label'=>function(CStation $CStation){
                return sprintf(' %s',$CStation->getNom());
                }
                ])   
        ;
    }
}
