<?php

namespace ILANEO\CongeBundle\Controller;

use ILANEO\CongeBundle\Entity\User;
use ILANEO\CongeBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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



    //page liste employés
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

/*public function editEmpAction( $id,Request $request  )
{ 
    $user=$this->getDoctrine()->getRepository('ILANEOCongeBundle:User')->find($id);
    
    $user->setFamilySituation($user->getFamilySituation());
    $user->setChildren($user->$getChildren());
    $user->setPhone($user->$getPhone());
    $user->setEmail($user->$getEmail());
    $user->setStatus($user->$getStatus());
    $user->setPost($user->$getPost());
    $user->setBankAccount($user->$getBankAccount());

    
    $form = $this->createFormBuilder($user)
        ->add('familySituation',ChoiceType::class,array('choices'=> array('célibataire'=>'célibataire','marié'=>'marié'),'expanded'=>true))
        ->add('children',IntegerType::class)
        ->add('phone', IntegerType::class)
        ->add('email', EmailType::class)
        ->add('status',ChoiceType::class, array('choices'=>array('stagiaire'=>'stagiaire','employé'=>'employé','ancien employé'=>'ancien employé')))
        ->add('post',TextType::class)
        ->add('bankAccount',IntegerType::class)
        ->getForm();

    $form ->handleRequest($request);

    if($form->isSubmitted() && $forl->isValid()){
        $familySituation=$form['familySituation']->getData();
        $children=$form['children']->getData();
        $phone=$form['phone']->getData();
        $email=$form['email']->getData();
        $status=$form['status']->getData();
        $post=$form['post']->getData();
        $bankAccount=$form['bankAccount']->getData();

        $em = $this->getDoctrine()->getManager();
        $user=$em->getRepository('ILANEOCongeBundle:User')->find($id);
         
        $user->setFamilySituation($familySituation);
        $user->setChildren($children);
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setStatus($status);
        $user->setPost($post);
        $user->setBankAccount($bankAccount);


        $em->flush();
          $this->addFlash('employé modifié');
        return $this->redirectToRoute('ilaneo_liste_employes');
    }

    // traitement si méthode get
    return $this->render('@ILANEOConge/employe/modifierEmp.html.twig',array('user'=>$user,'form'=>$form->createView()));
}

*/
public function editEmpAction( $id,Request $request  )
{

  //  $session = $request->getSession();
   // $id = $session->get('id');
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('ILANEOCongeBundle:User')->find($id);
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

    //$em=$this->getDoctrine()->getManager();
  //  $em->persist($user);
     $em->flush();

     $request->getSession()->getFlashBag()->add("notice","Vos changements ont été enregistré avec succée.");
     return $this->redirectToRoute('ilaneo_liste_employes');
 }

 // traitement si méthode get
 return $this->render('@ILANEOConge/admin/modifierEmp.html.twig',array('form'=>$form->createView()));

}

}
