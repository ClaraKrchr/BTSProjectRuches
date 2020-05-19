<?php
/* src/Form/AddStationFormType.php*/

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityRepository;
use App\Entity\CRucher;

class AddStationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('Nom_station')
            
            ->add('Rucher',EntityType::class, [
                'class'=>CRucher::class,
                'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->select('w')->from(CRucher::class, 'w')->orderBy('w.nom', 'ASC');
                },
                'choice_label'=>function(CRucher $CRucher){
                return sprintf(' %s',$CRucher->getNom());
                }                
            ])
            ->add('Date_installation', DateType::class, [
                'widget' => 'single_text',
                
            ])
        ;
            
    }
   
}
