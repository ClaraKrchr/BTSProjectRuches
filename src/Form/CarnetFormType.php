<?php

namespace App\Form;

use App\Entity\Carnet;
use App\Entity\CRuche;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarnetFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class, [
                'widget' => 'single_text',])
            ->add('commentaire')
            ->add('ruche',EntityType::class, [
                'class'=>CRuche::class,
                'choice_label'=>function(CRuche $CRuche){
                return sprintf(' %s',$CRuche->getNomruche());
                },
                'required'=>true
                ])
            ->add('etatruche', ChoiceType::class, [
                'choices'=> [
                    'Faible'=>'Faible',
                    'Moyenne'=>'Moyenne',
                    'Forte'=>'Forte',
                ],
                ])
            ->add('nbcadrescouvain')
            ->add('etatessaim', ChoiceType::class,[
                'choices'=> [
                    'Orpheline' => 'Orpheline',
                    'Bourdonneuse' => 'Bourdonneuse'
                ],
                'expanded' => true,
                'multiple' => true,
                'required'=> false,
                'label' => utf8_encode('État essaim')
            ])
            ->add('datereine', DateType::class, [
                'widget'=>'single_text', 'required'=>false])
            ->add('naturemiel', ChoiceType::class, [
                'choices'=> [
                    'Tournesol'=>'Tournesol',
                    'Colza'=>'Colza',
                    'Chataignier'=>'Chataignier',
                    'Acacia'=>'Acacia',
                    'Tilleul'=>'Tilleul',
                    'Ronce'=>'Ronce',
                    'Miel de printemps'=>'Miel de printemps',
                    'Miel d\'ete'=>'Miel d\'ete',
                    'Miel de foret'=>'Miel de foret',
                    'Miel de montagne'=>'Miel de montagne',
                ]
            ])
            ->add('presencevarroa', ChoiceType::class, [
                'choices'=> [
                    'Non visible'=>'Non visible',
                    'Faible'=>'Faible',
                    'Moyen'=>'Moyen',
                    'Important'=>'Important',
                ]
            ])
            ->add('lieutranshumance')
            ->add('presencemales', ChoiceType::class, [
                'choices'=>[
                    'Non'=>'Non',
                    'Oui'=>'Oui',
                ]
            ])
            ->add('presencelarves', ChoiceType::class, [
                'choices'=>[
                    'Non'=>'Non',
                    'Oui'=>'Oui',
                ]
            ])
            ->add('presenceoeufs', ChoiceType::class, [
                'choices'=>[
                    'Non'=>'Non',
                    'Oui'=>'Oui',
                ]
            ])
            ->add('couvainopercule', ChoiceType::class, [
                'choices'=>[
                    'Non'=>'Non',
                    'Oui'=>'Oui',
                ]
            ])
            ->add('cellulesroyales', ChoiceType::class, [
                'choices'=>[
                    'Non'=>'Non',
                    'Oui'=>'Oui',
                ]
            ])
            ->add('racereine')
            ->add('agereine')
            ->add('nbcadresmiel')
            ->add('nbcadrespollen')
            ->add('datetraitement', DateType::class, [
                'widget' => 'single_text','required'=>false])
            ->add('naturetraitement')
            ->add('datenourrissement', DateType::class, [
                'widget' => 'single_text','required'=>false])
            ->add('qttnourrissement')
            ->add('naturenourrissement')
            ->add('origineessaim', ChoiceType::class, [
                'choices'=> [
                    'Essaimage'=>'Essaimage',
                    'Division'=>'Division',
                    'Achat'=>'Achat',
                ]               
            ])
            ->add('nbhausserecoltees')
            ->add('daterecolte', DateType::class, [
                'widget'=> 'single_text','required'=>false])
            ->add('etatabeilles', ChoiceType::class, [
                'choices'=> [
                    'Grandes'=>'Grandes',
                    'Petites'=>'Petites',
                    'Ailes atrophiees'=>'Ailes atrophiees',
                    'Agressives'=>'Agressives',
                    'Douces'=>'Douces',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => utf8_encode('État abeilles')
            ])
            ->add('datetranshumance', DateType::class, [
                'widget'=>'single_text','required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carnet::class,
        ]);
    }
}
