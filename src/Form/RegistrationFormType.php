<?php
/* src/Form/RegistrationFormType.php */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationFormType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('Nom')      
            ->add('Prenom')            
            ->add('Adresse_mail')            
            ->add('Mot_de_passe',PasswordType::class)
            ->add('Telephone')        
            ->add('Code_postal')
            ->add('Ville')
            ->add('Adresse_postale')
            ;
    }
}

