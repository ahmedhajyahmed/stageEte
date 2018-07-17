<?php

namespace ILANEO\CongeBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class employeController extends Controller
{
    /*public function connexionAction()
    {
        $response= new Response();
        $response->setContent("<body>ahmed</body>");
        return $response;
        //return $this->render('ILANEOCongeBundle:employe:connexion.html.twig', array());
    }*/

    public function indexAction()
    {
        //$repository= $this->getDoctrine()->getManager()->getRepository('ILANEOCongeBundle:User');
        $user=$this->getUser();
        if($user==null)
        {
            return $this->redirectToRoute('fos_user_security_login');
        }

        return $this->render('@ILANEOConge\employe\index.html.twig',array('user' => $user));
        //return $this->render('ILANEOCongeBundle:employe:index.html.twig', array());
    }

    public function askAction()
    {
        //return $this->render('ILANEOCongeBundle:employe:demande.html.twig', array());
        return new Response('Ceci est une page de test ');
    }

    public function visualizationAction()
    {
        //return $this->render('ILANEOCongeBundle:employe:visualisation.html.twig', array());
    }

}
