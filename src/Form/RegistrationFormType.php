<?php
/* src/Form/RegistrationFormType.php */

namespace App\Form;

use App\Entity\CApiculteur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class RegistrationFormType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom')      
            ->add('prenom')            
            ->add('mail')            
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('tel')        
            ->add('Code_Postal')
            ->add('ville')
            ->add('post_addr')
            ;
    }
}

