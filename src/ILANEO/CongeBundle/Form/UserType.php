<?php

namespace ILANEO\CongeBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
            ->add('username', TextType::class)
            ->add('userFirstname', TextType::class)
            ->add('userLastname', TextType::class)
            ->add('cin',IntegerType::class)
            ->add('birthDate', DateType::class,array('widget' => 'single_text',))
            ->add('phone', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('cnss', IntegerType::class)
            ->add('recruitmentDate',DateType::class, array('widget' => 'single_text',))
            ->add('status',ChoiceType::class, array('choices'=>array('stagiaire'=>'stagiaire','employé'=>'employé','ancien employé'=>'ancien employé')))
            ->add('post',TextType::class)
            ->add('startingSalary',IntegerType::class)
            ->add('familySituation',ChoiceType::class,array('choices'=> array('célibataire'=>'célibataire','marié'=>'marié'),'expanded'=>true))
            ->add('roles', CollectionType::class, array(
                'entry_type'   => ChoiceType::class,
                'entry_options'  => array(
                    'choices'  => array(
                        'Oui' => 'ROLE_ADMIN',
                        'Non'     => 'ROLE_USER',
                    ),
                    'expanded'=>true,
                ),
            ))
            ->add('children',IntegerType::class)
            ->add('bankAccount',IntegerType::class)
            //->add('save',SubmitType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'mot de passe ', 'attr' => array('class'=> 'form-control m-input')),
                'second_options' => array('label' => 'confirmation du mot de passe','attr' => array('class'=> 'form-control m-input')),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    /**
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
