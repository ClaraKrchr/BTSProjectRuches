<?php
/* src/Form/FiltreRuchesFormType.php */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RuchesPubliquesFormType extends AbstractType 
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder        
        ->add('Nom_ruche')
        ->add('Proprietaire')
        ->add('Type',ChoiceType::class, [
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
            'required'=> false
        ]);        
    }    
}