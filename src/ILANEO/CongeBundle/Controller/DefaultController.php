<?php

namespace ILANEO\CongeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ILANEOConge/Default/index.html.twig');
    }
}
