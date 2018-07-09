<?php

namespace ILANEO\CongeBundle\Controller;

use ILANEO\CongeBundle\Entity\User;
use ILANEO\CongeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function attributionAction()
    {
        //return $this->render('ILANEOCongeBundle:Admin:attribution.html.twig', array( ) );
    }

    public function modifAction()
    {
        //return $this->render('ILANEOCongeBundle:Admin:modif.html.twig', array( ) );
        $response=new Response();
        $response->setContent('liste des employé');
        return $response;
    }

    public function ajoutAction(Request $request)
    {
        //return $this->render('ILANEOCongeBundle:Admin:ajout.html.twig', array( ) );
        $user=new User();
        $form=$this->createForm(UserType::class,$user);

        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notice","l'employé a été enregistré avec succée.");
            return $this->redirectToRoute('ilaneo_conge_modificationListeEmp');
        }

        return $this->render('@ILANEOConge/Admin/ajoutEmp.html.twig',array('form'=>$form->createView()));
    }

}
