<?php

namespace ILANEO\CongeBundle\Controller;

use ILANEO\CongeBundle\Entity\User;
use ILANEO\CongeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{


    //page liste des employés
    public function editAction()
    {
        //return $this->render('ILANEOCongeBundle:Admin:modif.html.twig', array( ) );
    }

    //page ajouter employé
    public function ajoutAction(Request $request)
    {

        $user=new User();
        //on récupére le formulaire
        $form=$this->createForm(UserType::class,$user);

        //traitement si formulaire envoyé et est valide
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            //on récupére le entity manager
            $em=$this->getDoctrine()->getManager();
            //on active l'utilisateur
            $user->setEnabled(true);
            //traitement pour calculer le nombre de congé en solde
            $recruitmentDate=$user->getRecruitmentDate();
            $today = date_create("now");
            $interval = date_diff( $today,$recruitmentDate);
            $res= $interval->days;
            $paidVacation=($res*2)/30;
            $user->setPaidVacation($paidVacation);
            //on enregistre les modifications
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notice","l'employé a été enregistré avec succée.");
            return $this->redirectToRoute('ilaneo_conge_connexion');
        }

        //traitement si méthode get
        return $this->render('@ILANEOConge/Admin/ajoutEmp.html.twig',array('form'=>$form->createView()));
    }

}
