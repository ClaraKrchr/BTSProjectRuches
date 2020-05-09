<?php
/* src/Form/AddRucheFormType.php*/

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CRucher;
use App\Entity\CApiculteur;
use App\Entity\CPeseRuche;

class AddRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('Nom_ruche')
            
            ->add('Date_installation',DateType::class, [               
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
            ->add('Rucher',EntityType::class, [
                'class'=>CRucher::class,
                'choice_label'=>function(CRucher $CRucher){
                return sprintf(' %s',$CRucher->getNom());
                },
                'required'=>false
                ])
            ->add('PeseRuche',EntityType::class, [
                'class'=>CPeseRuche::class,
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
   
}

