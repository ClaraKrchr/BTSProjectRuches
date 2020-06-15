<?php

namespace App\Form;

use App\Entity\Carnet;
use App\Entity\CRuche;
use App\Entity\AssocierRucheApiculteur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;

class CarnetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ruche',EntityType::class, [
                'class'=>CRuche::class,
                'query_builder' => function(EntityRepository $er) use($options){
                return $er->createQueryBuilder('u')->select('w')->from(CRuche::class, 'w')->join(AssocierRucheApiculteur::class, 'a')->where('w.id = a.ruche AND a.apiculteur = :user')->orderBy('w.nomruche', 'ASC')->setParameter('user', $options['user']);
                },
                'choice_label'=>function(CRuche $CRuche){
                return sprintf(' %s',$CRuche->getNomruche());
                },
                'required'=>true
                ])            
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'user' => null,
        ));
    }
}
