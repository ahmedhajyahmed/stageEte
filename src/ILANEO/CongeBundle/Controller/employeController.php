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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class EmployeController extends Controller 
{

    //page d'accueim
    public function indexAction()
    {
        $user=$this->getUser();
        /*
        l'utlisateur n'accéde à la page que s'il est authentifié
        */
        if($user==null)
        {
            return $this->redirectToRoute('fos_user_security_login');// redirection pour s'authentifier
        }

        return $this->render('@ILANEOConge\Employe\index.html.twig',array('user' => $user));
    }

    //page modifier profile
    public function profileEditAction(Request $request)
    {
        //on recupére l'utilisateur
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

        //on recupére la formulaire
        $form = $formBuilder->getForm();

        //traitement si le formulaire est envoyé et est valide
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add("notice","Vos changements ont été enregistré avec succée.");
            return $this->redirectToRoute('ilaneo_conge_connexion');
        }

        // traitement si méthode get
        return $this->render('@ILANEOConge/employe/profileEdit.html.twig',array('form'=>$form->createView()));
    }

    public function askAction()
    {
        //return $this->render('ILANEOCongeBundle:Employe:demande.html.twig', array());
        return $this->render('@ILANEOConge/Employe/AskVacation.html.twig',array());
    }



    public function annualVacationAction(Request $request)
    {
        //on récupére le formulaire 

        $askVacation=new AskVacation();
        $user=$this->getUser();
        $askVacation->setTypeVacation("congé annuel");
        $askVacation->setUser($user);
        
        $form = $this->createform(AnnualVacationType::class , $askVacation );
       
       

        if ($request->isMethod('POST')) 
        {
            
            $form->handleRequest($request);
      
            if ($form->isValid()) 
            {
                  $em = $this->getDoctrine()->getManager();
              $em->persist($askVacation);
              $em->flush();
              $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
             
             
                
             $pattern=$form["pattern"]->getData();
             $askDate=$askVacation->getAskDate();
             $startDate=$form["startDate"]->getData();
             $endDate=$form["endDate"]->getData();

             $userFirstname=$user->getUserFirstname();
             $userLastname=$user->getUserLastname();

              //on prépare le message à envoyé
              $message = (new \Swift_Message('Demande de congé'))
              ->setFrom($user->getEmail())
              ->setTo('farah.attia24@gmail.com')
              ->setBody(
                 $this->renderView(
                     '@ILANEOConge/annualVacationEmail.html.twig',
                     array("askDate" => $askDate,"startDate" => $startDate,"endDate" => $endDate,
                           "userFirstname" => $userFirstname,"userLastname" => $userLastname)
                 ),
                 'text/html')
             ;

              //on envoye le message
              $this->get('mailer')->send($message);
              $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
      
              return $this->redirectToRoute('ilaneo_conge_connexion');
           }
        }   
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/AnnualVacation.html.twig',array('form'=>$formView, 'user' =>$user,));
    }

    public function SickVacationAction(Request $request)
    {
        $user=$this->getUser();
        $askVacation=new AskVacation();
        $askVacation->setUser($user);
        $askVacation->setTypeVacation("congé de maladie");

        //on récupére le formulaire 
        $form = $this->createform(SickVacationType::class , $askVacation );

        if ($request->isMethod('POST')) 
        {   
            $form->handleRequest($request);
      
            if ($form->isValid()) 
            {
              
              $em = $this->getDoctrine()->getManager();
              $em->persist($askVacation);
              $em->flush();
              $request->getSession();
                
              $pattern=$form["pattern"]->getData();
              $supportingDoc=$form["supportingDoc"]->getData();
              $askDate=$askVacation->getAskDate();
              $startDate=$form["startDate"]->getData();
              $endDate=$form["endDate"]->getData();

              $userFirstname=$user->getUserFirstname();
              $userLastname=$user->getUserLastname();

              //on prépare le message à envoyé
              $message = (new \Swift_Message('Demande de congé'))
              ->setFrom($this->container->getParameter('mailer_user'))
              ->setTo('farah.attia24@gmail.com')
              ->setBody(
                $this->renderView(
                    '@ILANEOConge/sickVacationEmail.html.twig',
                    array("pattern" => $pattern,"supportingDoc" => $supportingDoc,"askDate" => $askDate,
                       "startDate" => $startDate,"endDate" => $endDate,"userFirstname" => $userFirstname,"userLastname" => $userLastname)
                ),
                'text/html')
             ;
             

              //on envoye le message
              $this->get('mailer')->send($message);
              $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
      
              return $this->redirectToRoute('ilaneo_conge_connexion');
            }

       
        }   
            
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();


        return $this->render('@ILANEOConge/Employe/SickVacation.html.twig',array('form'=>$formView , 'user' =>$user,));
    }

    public function UnpaidVacationAction(Request $request)
    {   
        $user=$this->getUser();  
        $askVacation=new AskVacation();
        $askVacation->setTypeVacation("congé sans solde");
        $askVacation->setUser($user);

        $form = $this->createform(UnpaidVacationType::class , $askVacation );

        if ($request->isMethod('POST')) 
        {   
            $form->handleRequest($request);
      
            if ($form->isValid()) 
            {
              
              $em = $this->getDoctrine()->getManager();
              $em->persist($askVacation);
              $em->flush();
              $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
              
             $pattern=$form["pattern"]->getData();
             $supportingDoc=$form["supportingDoc"]->getData();
             $askDate=$askVacation->getAskDate();
             $startDate=$form["startDate"]->getData();
             $endDate=$form["endDate"]->getData();

             $userFirstname=$user->getUserFirstname();
             $userLastname=$user->getUserLastname();

              //on prépare le message à envoyé
              $message = (new \Swift_Message('Demande de congé'))
              ->setFrom($user->getEmail())
              ->setTo('farah.attia24@gmail.com')
              ->setBody(
                 $this->renderView(
                     '@ILANEOConge/unpaidVacationEmail.html.twig',
                     array("pattern" => $pattern,"supportingDoc" => $supportingDoc,"askDate" => $askDate,
                        "startDate" => $startDate,"endDate" => $endDate,"userFirstname" => $userFirstname,"userLastname" => $userLastname)
                 ),
                 'text/html')
             ;

              //on envoye le message
              $this->get('mailer')->send($message);
              $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
      
              return $this->redirectToRoute('ilaneo_conge_connexion');
            }

       
        }    

        
            
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/UnpaidVacation.html.twig',array('form'=>$formView , 'user' =>$user,));
    }

    public function ExceptionalVacationAction(Request $request)
    {   
        $user=$this->getUser();
        $askVacation=new AskVacation();
        $askVacation->setUser($user);   
        $askVacation->setTypeVacation("congé exceptionnel");

        //on récupére le formulaire 
        
       
        $form = $this->createform(ExceptionalVacationType::class , $askVacation );

        if ($request->isMethod('POST')) 
        {   
            $form->handleRequest($request);
      
            if ($form->isValid()) 
            {
              
              $em = $this->getDoctrine()->getManager();
              $em->persist($askVacation);
              $em->flush();
              $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
                

              $pattern=$form["pattern"]->getData();
              $supportingDoc=$form["supportingDoc"]->getData();
              $askDate=$askVacation->getAskDate();
              $startDate=$form["startDate"]->getData();
              $endDate=$form["endDate"]->getData();

              $userFirstname=$user->getUserFirstname();
              $userLastname=$user->getUserLastname();

               //on prépare le message à envoyé
               $message = (new \Swift_Message('Demande de congé'))
               ->setFrom($user->getEmail())
               ->setTo('farah.attia24@gmail.com')
               ->setBody(
                  $this->renderView(
                      '@ILANEOConge/exceptionalVacationEmail.html.twig',
                      array("pattern" => $pattern,"supportingDoc" => $supportingDoc,"askDate" => $askDate,
                        "startDate" => $startDate,"endDate" => $endDate,"userFirstname" => $userFirstname,"userLastname" => $userLastname)
                  ),
                  'text/html')
              ;

                 //on envoye le message
                 $this->get('mailer')->send($message);
                 $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
      
              return $this->redirectToRoute('ilaneo_conge_connexion');
            }

       
        }    
        //on génére le HTML du formulaire créé
        
        $formView = $form->createView();

        //on rend la vue

        return $this->render('@ILANEOConge/Employe/ExceptionalVacation.html.twig',array('form'=>$formView , 'user' =>$user,));
    }

    public function AuthorizationVacationAction(Request $request)
    {
        $user=$this->getUser(); 
        $askVacation=new AskVacation();
        $askVacation->setUser($user);
        $askVacation->setTypeVacation("Authorisation d'absence");
        //on récupére le formulaire
        $form = $this->createform(AuthorizationVacationType::class , $askVacation );
        
        ;
          
        //on génére le HTML du formulaire créé
    
        if ($request->isMethod('POST')) 
        {   
            $form->handleRequest($request);
      
            if ($form->isValid()) 
            {
              
                 $em = $this->getDoctrine()->getManager();
                 $em->persist($askVacation);
                 $em->flush();
                 $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
      
                 $pattern=$form["pattern"]->getData();
                 $supportingDoc=$form["supportingDoc"]->getData();
                 $askDate=$askVacation->getAskDate();
                 $startDate=$form["startDate"]->getData();
                 $endDate=$form["endDate"]->getData();

                 $userFirstname=$user->getUserFirstname();
                 $userLastname=$user->getUserLastname();

                 //on prépare le message à envoyé
                 $message = (new \Swift_Message('Demande de congé'))
                 ->setFrom($user->getEmail())
                 ->setTo('farah.attia24@gmail.com')
                 ->setBody(
                    $this->renderView(
                        '@ILANEOConge/authorizationVacationEmail.html.twig',
                        array('pattern' => $pattern,'supportingDoc' => $supportingDoc,'askDate' => $askDate,
                        'startDate' => $startDate,'endDate' => $endDate,'userFirstname' => $userFirstname,'userLastname' => $userLastname)
                    ),
                    'text/html')
                ;

                 //on envoye le message
                 $this->get('mailer')->send($message);
                 $request->getSession()->getFlashBag()->add('submit-notice', 'Votre demande de congé a bien été envoyée');
            
              return $this->redirectToRoute('ilaneo_conge_connexion');

            }
        }
       
        //on rend la vue

        $formView = $form->createView();

        return $this->render('@ILANEOConge/Employe/AuthorizationVacation.html.twig',array('form'=>$formView,'user'=>$user));
    
    
    }

    //page mot de passe oublié
    public function resetPasswordAction(Request $request)
    {
        $user= new user();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $user);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('email', EmailType::class);

        //on recupére la formulaire
        $form = $formBuilder->getForm();

        //traitement si le formulaire est envoyé et est valide
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            //on  récupére l'adresse email écrite au formulaire
            $email=$form['email']->getData();

            // on récupére le service user manager
            $userManager = $this->container->get('fos_user.user_manager');
            // on récupére l'utilisateur dont l'email est $email
            $userEmail = $userManager->findUserByUsernameOrEmail($email);
            //on obtient son prénom
            $userFirstname=$userEmail->getUserFirstname();

            if (null !== $userEmail) {
                //on crée un nouveau mot de passe
                $password = rand(0, 9) . chr(rand(65, 90)) . rand(0, 9) . chr(rand(65, 90)) . rand(0, 9) . chr(rand(65, 90)) . rand(0, 9) . chr(rand(65, 90)) . rand(0, 9) . chr(rand(65, 90));
                //on change son mot de passe
                $userEmail->setPlainPassword($password)
                    ->setPasswordRequestedAt(new \DateTime());

                //on enregistre les modification
                $userManager->updateUser($userEmail);
            }

            //on prépare le message à envoyé
            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('xxx@gmai.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                        '@ILANEOConge/email.html.twig',
                        array('userFirstname' => $userFirstname,'password'=>$password)
                    ),
                    'text/html')
                ;

            //on envoye le message
            $this->get('mailer')->send($message);
            $request->getSession()->getFlashBag()->add("notice","Veuillez verifier votre courier électronique.");
            //redirection vers l'accueil
            return $this->redirectToRoute('ilaneo_conge_connexion');
        }
        //traitement si méthode get
        return $this->render('@ILANEOConge/employe/resetPassword.html.twig',array('form'=>$form->createView()));
    }



    //page mes demandes
    public function myRequestsAction()
    {

        /*$eventsloaded = $this->container->get('calendarbundle.serviceloadcalendar')->loadCalendar();
        $responseData = [];
        foreach ($eventsloaded as $i => $event) {
            $responseData[$i] = $event->toArray();
        }

        $eventt= new JsonResponse($responseData);
        dump($eventt);die();*/

        return $this->render('@ILANEOConge/employe/myRequests.html.twig');
    }

    public function calculateDateAction()
    {
        dump("ahmedAction");die();
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('ILANEOCongeBundle:AskVacation');
        $evenements=$repository->findAll();
        $event = array();
        foreach ($evenements as $evenement){
            $event[] =array(
                'id'=> $evenement->getId(),
                'title' => $evenement->getTypeVacation(),
                'start' => $evenement->getStartDate(),
                'end' => $evenement->getEndDate()
            )
            ;
        }
        $events = new JsonResponse($event);

        return $events ;
    }
}
