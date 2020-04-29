<?php
/* src/Form/AddRucheFormType.php*/

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AddRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('Nom_ruche')
            ->add('Proprietaire')
            ->add('Rucher')
            ->add('Date_installation',DateType::class, [
                'widget' => 'single_text', 
                
            ])
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

