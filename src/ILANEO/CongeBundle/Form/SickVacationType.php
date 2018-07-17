<?php

namespace ILANEO\CongeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SickVacationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('startDate', DateTimeType::class,array('widget' => 'single_text',))
        ->add('endDate', DateTimeType::class,array('widget' => 'single_text',))
       
        ->add('supportingDoc', TextareaType::class)
        ->add('pattern', TextareaType::class)
        ->add('submit', SubmitType::class);
        
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ILANEO\CongeBundle\Entity\AskVacation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ilaneo_congebundle_Sickvacation';
    }


}