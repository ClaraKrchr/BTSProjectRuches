<?php

/* src/Form/FiltreRuchesFormType.php */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RuchesPubliquesFormType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        
        $builder
        ->add('nomPropio')
        ->add('nomRuche')
        ;
    }
    
}