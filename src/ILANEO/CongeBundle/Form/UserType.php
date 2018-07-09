<?php

namespace ILANEO\CongeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('cin',IntegerType::class)
            ->add('dateNaissance', DateType::class,array('widget' => 'single_text',))
            ->add('tel', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('cnss', IntegerType::class)
            ->add('dateRecrutement',DateType::class, array('widget' => 'single_text',))
            ->add('statut',ChoiceType::class, array('choices'=>array('stagiaire'=>'stagiaire','employé'=>'employé','ancien employé'=>'ancien employé')))
            ->add('poste',TextType::class)
            ->add('salaireDepart',IntegerType::class)
            ->add('situationFamiliale',ChoiceType::class,array('choices'=> array('célibataire'=>'célibataire','marié'=>'marié')))
            ->add('enfantCharge',IntegerType::class)
            ->add('login',TextType::class)
            ->add('mp',PasswordType::class)
            ->add('admin',CheckboxType::class)
            ->add('matricule',IntegerType::class)
            ->add('compteBancaire',IntegerType::class)
            ->add('save',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ILANEO\CongeBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ilaneo_congebundle_user';
    }


}
