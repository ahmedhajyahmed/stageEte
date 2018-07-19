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
    public function testAction()
    {
        return new Response('Ceci est une page de test');
    }

    public function editAction()
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
            $user->setEnabled(true);
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notice","l'employé a été enregistré avec succée.");
            return $this->redirectToRoute('ilaneo_conge_connexion');
        }

        return $this->render('@ILANEOConge/Admin/ajoutEmp.html.twig',array('form'=>$form->createView()));
    }

}
