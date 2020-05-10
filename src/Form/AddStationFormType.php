<?php
/* src/Form/AddStationFormType.php*/

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\CRucher;

class AddStationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('Nom_station')
            
            ->add('Rucher',EntityType::class, [
                'class'=>CRucher::class,
                'choice_label'=>function(CRucher $CRucher){
                return sprintf(' %s',$CRucher->getNom());
                }                
            ])
            ->add('Date_installation', DateType::class, [
                'widget' => 'single_text',
                
            ])
        ;
            
    }
   
}