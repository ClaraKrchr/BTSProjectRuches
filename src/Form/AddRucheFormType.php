<?php
/* src/Form/AddRucheFormType.php*/

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddRucheFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
        ->add('Nom_ruche')
        //->add('Date_installation')
        ->add('Type')
        ->add('Visibilite')
        ;
    }
}

