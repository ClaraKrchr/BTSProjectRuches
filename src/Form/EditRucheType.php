<?php

namespace App\Form;

use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\CPeseRuche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class EditRucheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom_ruche')
            ->add('Date_install',DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('Etat',ChoiceType::class,
                array(
                    'choices'=>array(
                        'En attente'=>'0',
                        'Dans un rucher'=>'1',
                        'Chez un apiculteur'=>'2'
                    )
                )
                )
            ->add('Type_ruche',ChoiceType::class, [
                'choices'=> [
                    'Ruches en paille'=>'Ruches en paille',
                    'Ruche kenyane(KTBH)'=>'Ruche kenyane(KTBH)',
                    'Ruche Tronc'=>'Ruche Tronc',
                    'Ruche alsacienne(Ruche Bastian)'=>'Ruche alsacienne(Ruche Bastian)',
                    'Ruche horizontales'=>'Ruche horizontales',
                    'Ruche Dadant'=>'Ruche Dadant',
                    'Ruche Langstroth(standard)'=>'Ruche Langstroth(standard)',
                    'Ruche Voirnot'=>'Ruche Voirnot',
                    'Ruche Warre(ruche populaire)'=>'Ruche Warre(ruche populaire)',
                    'Ruche Layens'=>'Ruche Layens',
                    'Ruche William Braughton Carr'=>'Ruche William Braughton Carr',
                    'Ruche de production'=>'Ruche de production',
                ],
            ])
            ->add('associationRucheRucher',EntityType::class, [
                'class'=>CRucher::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->select('w')->from(CRucher::class, 'w')->orderBy('w.nom', 'ASC');
                },
                'choice_label'=>function(CRucher $CRucher){
                return sprintf(' %s',$CRucher->getNom());
                },
                'required'=>false
                ])
            ->add('associationRuchePeseruche',EntityType::class, [
                'class'=>CPeseRuche::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->select('w')->from(CPeseRuche::class, 'w')->orderBy('w.nompeseruche', 'ASC');
                },
                'choice_label'=>function(CPeseRuche $CPeseRuche){
                return sprintf(' %s',$CPeseRuche->getNomPeseRuche());
                },
                'required'=>false
                ])
            ->add('Visibilite',ChoiceType::class,
                array(
                    'choices'=>array(
                        'Publique'=>'0',
                        'Privee'=>'1',
                    ),
                    'expanded'=>true,
                    'multiple'=>false
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CRuche::class,
        ]);
    }
}
