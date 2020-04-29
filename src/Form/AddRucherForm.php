<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;

class AddRucherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('Region',
            ChoiceType::class,
            array(
                'choices'=>array(
                    ''=>'',
                    'Auvergne-Rhones-Alpes'=>'Auvergne-Rhones-Alpes',
                    'Bourgogne-Franche-Comte'=>'Bourgogne-Franche-Comte',
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
                    'Provence-Alpes-Cotes-d-Azur'=>'Provence-Alpes-Cotes-d-Azur')
                )
            )
        ->add('Nb_Ruche')
        ->add('Latitude')
        ->add('Longitude')
        ->add('Nom')
        ;
    }
}