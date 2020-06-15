<?php

namespace App\Form;

use App\Entity\CRuche;
use App\Entity\CApiculteur;
use App\Entity\AssocierRucheApiculteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class EditAssosRucheApiculteurType extends AbstractType
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
            ->add('apiculteur',EntityType::class, [
                'class'=>CApiculteur::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->select('w')->from(CApiculteur::class, 'w')->orderBy('w.nom', 'ASC');
                },
                'choice_label'=>function(CApiculteur $CApiculteur){
                return sprintf(' %s',$CApiculteur->getNom());
                }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssocierRucheApiculteur::class,
        ]);
    }
}
