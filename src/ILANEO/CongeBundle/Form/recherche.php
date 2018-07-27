<?php

namespace ILANEO\CongeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RechercheType extends AbstractType
{

public function buildFrom(FormBuilderInterface $builder, array $option)
{
$builder->add('recherche','text');
}


public function getName()
{
    return 'ilaneo_CongeBundle_recherche';
}

}