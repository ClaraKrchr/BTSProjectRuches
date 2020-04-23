<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class AddRucherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('Localisation')
        ->add('Nb_Ruche')
        ->add('Latitude')
        ->add('Longitude')
        ->add('Nom')
        ;
    }
}