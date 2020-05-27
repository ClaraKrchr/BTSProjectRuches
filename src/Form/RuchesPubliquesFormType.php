<?php
/* src/Form/FiltreRuchesFormType.php */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use App\Entity\CApiculteur;
use App\Entity\CRuche;


class RuchesPubliquesFormType extends AbstractType 
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder        
        ->add('Nom_ruche',EntityType::class,[
            'class'=>CRuche::class,
            'choice_label'=> function(CRuche $CRuche){
            if($CRuche->getVisibilite()==false)return sprintf("%s",$CRuche->getNomruche());else return null;
            },
            'placeholder'=>'',
            'required'=> false
        ])
        ->add('Proprietaire',EntityType::class,[
            'class'=>CApiculteur::class,
            'placeholder'=>'',
            'required'=> false
        ])
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