<?php
/* src/Form/FiltreRuchesFormType.php */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RuchesPubliquesFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        
        $builder
        ->add('Proprietaire')
        ->add('Nom_ruche')
        ->add('Type_T')
        ->add('Visibilite')
        ->add('Type_C', ChoiceType::class, [
            'choices'=> [
                ''=>'',
                'Type1' => 'type1',
                'Type2' => 'type2',
                'Type3' => 'type3',
                'Type4' => 'type4',
            ]
        ])
        ->add('Region', ChoiceType::class, [
            'choices'=> [
                ''=>'',
                'Auvergne-Rhones-Alpes'=>'Auvergne-Rhones-Alpes',
                'Bourgogne-Franche-Comte'=>'Bourgogn-Franche-Comte',
                'Bretagne' =>'Bretagne',
                'Centre-Val-de-Loire'=>'Centre-Val-de-Loire',
                'Corse'=>'Corse',
                'Grand-Est'=>'Grand-Est',
                'Hauts-de-France'=>'Hauts-de-France',
                'Ile-de-France'=>'Ile-de-France',
                'Normandie'=>'Normandie',
                'Nouvelle-Aquitaine'=>'Nouvelle-Aquitaine',
                'Occitanie'=>'Occitanie',
                'Pays-de-la-Loire'=>'Pays-de-la-Loire',
                'Provence-Alpes-Cotes-d-Azur'=>'Provence-Alpes-Cotes-d-Azur'
            ]
        ])
        ;
    }    
}