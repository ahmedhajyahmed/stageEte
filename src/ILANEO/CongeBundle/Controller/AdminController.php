<?php

namespace ILANEO\CongeBundle\Controller;

use ILANEO\CongeBundle\Entity\User;
use ILANEO\CongeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ILANEO\CongeBundle\form\RechercheType;
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




   public function listeEmployesAction (Request  $request)
    {

       $userdets = $this->getDoctrine()->getRepository('ILANEOCongeBundle:User')->findAll();
       return $this->render('@ILANEOConge/Admin/listeEmployes.html.twig', array('viewUserdets'=>$userdets));
    }
/*
public public function rechercheAction()
{
    $form=$this->createForm(new RechercheType());
   return $this->render('@ILANEOConge/Admin/recherche.html.twig', array('form'=>$form->createView()));

}

public function rechercheTraitementAction  ()
{ 
$form=$this->createForm(new RechercheType());
if($this->get('request')->getMethod()=='POST')
{
    $form->bind($this->get('request'));
    $em= $this->getDoctrine()->getManager();
    $users= $em->getRepository('ILANEOCongeBundle:User')->recherche( $form{'recherchee'}-getData());
}
    return $this->render('@ILANEOConge/Admin/listeEmployes.html.twig', array('users'=>$users));
}

/*public function rechercheAction  (Request  $request)
{

$em=$this->getDoctrine()->getManager();
$motcle=$request->get('motcle');
$repostery=$em->getRepository('ILANEOCongeBundle:user')

$query=$repository->createQueryBuilder('u')
->where('u.userFirstname = : userFirstname')
->setParameter('userFirstname',$motcle)
->orderBy('u.userFirstname','ASC')
->getQuery();

$listeEmployes= $query->getResult();
$entities = $this->getR('knp_paginator')->paginate(
    $listeEmployes,
    $request->query->get('page',1),
    6);

return $this->redirectToRoute('ilaneo_conge_connexion');
}*/



}
