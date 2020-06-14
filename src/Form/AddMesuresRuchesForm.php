<?php

namespace App\Form;

use App\Entity\MesuresRuches;
use App\Entity\CRuche;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Doctrine\ORM\EntityRepository;

class AddMesuresRuchesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('ruche',IntegerType::class)
            ->add('datereleve', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('poids',IntegerType::class)
        ;
    }
}
