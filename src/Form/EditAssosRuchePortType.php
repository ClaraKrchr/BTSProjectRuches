<?php

namespace App\Form;

use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\CStation;
use App\Entity\AssocierRuchePort;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class EditAssosRuchePortType extends AbstractType
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
            ->add('station',EntityType::class, [
                'class'=>CStation::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->select('w')->from(CStation::class, 'w')->orderBy('w.nom', 'ASC');
                },
                'choice_label'=>function(CStation $CStation){
                return sprintf(' %s',$CStation->getNom());
                }
                ])
            ->add('numport',ChoiceType::class,
                array(
                    'choices'=>array(
                        '1'=>'1',
                        '2'=>'2',
                        '3'=>'3',
                        '4'=>'4',
                        '5'=>'5',
                        '6'=>'6',
                        '7'=>'7',
                        '8'=>'8',
                        '9'=>'9',
                        '10'=>'10',
                        '11'=>'11',
                        '12'=>'12',
                        '13'=>'13',
                        '14'=>'14',
                        '15'=>'15'
                    )
                )
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssocierRuchePort::class,
        ]);
    }
}
