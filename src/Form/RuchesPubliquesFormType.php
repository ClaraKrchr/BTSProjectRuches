<?php
/* src/Form/FiltreRuchesFormType.php */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;


use App\Entity\CApiculteur;
use App\Entity\CRuche;
use App\Entity\CRucher;
use App\Entity\AssocierRucheRucher;


class RuchesPubliquesFormType extends AbstractType 
{    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder        
        ->add('Nom_ruche',EntityType::class,[
            'class'=>CRuche::class,
            'query_builder' => function(EntityRepository $er) use($options){
            return $er->createQueryBuilder('u')->select('w')->from(CRuche::class, 'w')->join(AssocierRucheRucher::class, 'a')->join(CRucher::class, 'r')->where('w.visibilite = 0 AND w.id = a.ruche AND a.rucher = r.id AND r.region = :region')->orderBy('w.nomruche', 'ASC')->setParameter('region', $options['region']);
            },
            'choice_label'=>function(CRuche $CRuche){
            return sprintf(' %s',$CRuche->getNomruche());
            },
            'placeholder'=>'',
            'required'=> false
        ])
        ->add('Proprietaire',EntityType::class,[
            'class'=>CApiculteur::class,
            'query_builder' => function(EntityRepository $er){
            return $er->createQueryBuilder('u')->select('w')->from(CApiculteur::class, 'w')->orderBy('w.pseudo', 'ASC');
            },
            'choice_label'=>function(CApiculteur $CApiculteur){
                return sprintf('%s', $CApiculteur->getPseudo());
            },
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
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'region' => null,
        ));
    }
}