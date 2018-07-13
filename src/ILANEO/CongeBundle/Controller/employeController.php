<?php

namespace ILANEO\CongeBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class employeController extends Controller
{
    public function connexionAction()
    {
        $response= new Response();
        $response->setContent("<body>ahmed</body>");
        return $response;
        //return $this->render('ILANEOCongeBundle:employe:connexion.html.twig', array());
    }

    public function indexAction($id)
    {
        $repository= $this->getDoctrine()->getManager()->getRepository('ILANEOCongeBundle:User');
        $user=$repository->find($id);
        if($user==null)
        {
            throw new NotFoundHttpException("l'utilisateur n'existe pas. ");
        }

        return $this->render('@ILANEOConge\employe\index.html.twig',array('user' => $user));
        //return $this->render('ILANEOCongeBundle:employe:index.html.twig', array());
    }

    public function demandeAction()
    {
        //return $this->render('ILANEOCongeBundle:employe:demande.html.twig', array());
    }

    public function visualisationAction()
    {
        //return $this->render('ILANEOCongeBundle:employe:visualisation.html.twig', array());
    }

}
