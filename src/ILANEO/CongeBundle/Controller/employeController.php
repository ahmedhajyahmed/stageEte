<?php

namespace ILANEO\CongeBundle\Controller;

use ILANEO\CongeBundle\config\rout;
use ILANEO\CongeBundle\Entity\AskVacation;
use ILANEO\CongeBundle\Entity\User;
use ILANEO\CongeBundle\Form\AnnualVacationType;
use ILANEO\CongeBundle\Form\SickVacationType;
use ILANEO\CongeBundle\Form\UnpaidVacationType;
use ILANEO\CongeBundle\Form\ExceptionalVacationType;
use ILANEO\CongeBundle\Form\AuthorizationVacationType;
use ILANEO\CongeBundle\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeController extends Controller 
{
    /*public function verifLoginAction()
    {

        return $this->redirectToRoute('ilaneo_conge_connexion');
    }*/

    public function indexAction()
    {
        //$repository= $this->getDoctrine()->getManager()->getRepository('ILANEOCongeBundle:User');
        $user=$this->getUser();
        if($user==null)
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->render('@ILANEOConge\Employe\index.html.twig',array('user' => $user));
        //return $this->render('ILANEOCongeBundle:Employe:index.html.twig', array());
    }

    public function profileEditAction(Request $request)
    {
        $user=$this->getUser();
        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('familySituation',ChoiceType::class,array('choices'=> array('célibataire'=>'célibataire','marié'=>'marié'),'expanded'=>true))
            ->add('children',IntegerType::class)
            ->add('phone', IntegerType::class)
            ->add('email', EmailType::class)
            ->add('status',ChoiceType::class, array('choices'=>array('stagiaire'=>'stagiaire','employé'=>'employé','ancien employé'=>'ancien employé')))
            ->add('post',TextType::class)
            ->add('bankAccount',IntegerType::class);

        $form = $formBuilder->getForm();

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notice","Vos changements ont été enregistré avec succée.");
            return $this->redirectToRoute('ilaneo_conge_connexion');
        }

        return $this->render('@ILANEOConge/employe/profileEdit.html.twig',array('form'=>$form->createView()));
    }

    public function askAction()
    {
        //return $this->render('ILANEOCongeBundle:Employe:demande.html.twig', array());
        return $this->render('@ILANEOConge/Employe/AskVacation.html.twig',array());
    }

    public function visualizationAction()
    {
        //return $this->render('ILANEOCongeBundle:Employe:visualisation.html.twig', array());
    }

    public function annualVacationAction()
    {
        //on récupére le formulaire 

        $askVacation=new AskVacation();
        $user=new user();
         
       
        $form = $this->createform(AnnualVacationType::class , $askVacation );
       
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/AnnualVacation.html.twig',array('form'=>$formView, 'user' =>$user,));
    }

    public function SickVacationAction()
    {
        $user=$this->getUser();
        //on récupére le formulaire 

        $askVacation=new AskVacation();
        $form = $this->createform(SickVacationType::class , $askVacation );
            
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/SickVacation.html.twig',array('form'=>$formView , 'user' =>$user,));
    }

    public function UnpaidVacationAction()
    {   
        $user=$this->getUser();
        //on récupére le formulaire 

        $askVacation=new AskVacation();
        $form = $this->createform(UnpaidVacationType::class , $askVacation );
            
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/UnpaidVacation.html.twig',array('form'=>$formView , 'user' =>$user,));
    }

    public function ExceptionalVacationAction()
    {   
        $user=$this->getUser();
        //on récupére le formulaire 

        $askVacation=new AskVacation();
        $form = $this->createform(ExceptionalVacationType::class , $askVacation );
            
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/ExceptionalVacation.html.twig',array('form'=>$formView , 'user' =>$user,));
    }

    public function AuthorizationVacationAction()
    {
        $user=$this->getUser();
        //on récupére le formulaire 

        $askVacation=new AskVacation();
        $form = $this->createform(AuthorizationVacationType::class , $askVacation );
            
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/AuthorizationVacation.html.twig',array('form'=>$formView,'user'=>$user));
    }

}
