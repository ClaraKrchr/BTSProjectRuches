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

class AddRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('Nom_ruche')
            ->add('Proprietaire'/*,EntityType::class,[
                'class'=>CApiculteur::class,
                'choice_label'=>function(CApiculteur $CApiculteur){
                return sprintf('(%d) %s',$CApiculteur->getId(),$CApiculteur->getNom());
                }
                ]*/)
            ->add('Rucher',EntityType::class,[
                'class'=>CRucher::class,
                'choice_label'=>function(CRucher $CRucher){
                return sprintf('(%d) %s',$CRucher->getId(),$CRucher->getNom());
                }
            ])
            ->add('Date_installation',DateType::class, [
                'widget' => 'single_text', 
                
            ])
            ->add('Poids')
            ->add('Type')
            ->add('Visibilite',ChoiceType::class,
                array(
                    'choices'=>array(
                        'Public'=>'0',
                        'Privee'=>'1',
                        )))
        ;
    }
}

