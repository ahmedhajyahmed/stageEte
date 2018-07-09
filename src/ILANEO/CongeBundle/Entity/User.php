<?php

namespace ILANEO\CongeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ILANEO\CongeBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="bigint", unique=true)
     */
    private $cin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="bigint")
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="cnss", type="bigint", unique=true)
     */
    private $cnss;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_recrutement", type="date")
     */
    private $dateRecrutement;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=255)
     */
    private $poste;
    /**
     * @var float
     *
     * @ORM\Column(name="salaire_depart", type="float")
     */
    private $salaireDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="situation_familiale", type="string", length=255)
     */
    private $situationFamiliale;

    /**
     * @var int
     *
     * @ORM\Column(name="enfant_charge", type="integer")
     */
    private $enfantCharge;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, unique=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="mp", type="string", length=255)
     */
    private $mp;

    /**
     * @var bool
     *
     * @ORM\Column(name="admin", type="boolean")
     */
    private $admin;

    /**
     * @var int
     *
     * @ORM\Column(name="matricule", type="bigint", unique=true)
     */
    private $matricule;

    /**
     * @var int
     *
     * @ORM\Column(name="compte_bancaire", type="bigint")
     */
    private $compteBancaire;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Employe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Employe
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return Employe
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Employe
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return Employe
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Employe
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cnss
     *
     * @param integer $cnss
     *
     * @return Employe
     */
    public function setCnss($cnss)
    {
        $this->cnss = $cnss;

        return $this;
    }

    /**
     * Get cnss
     *
     * @return int
     */
    public function getCnss()
    {
        return $this->cnss;
    }

    /**
     * Set dateRecrutement
     *
     * @param \DateTime $dateRecrutement
     *
     * @return Employe
     */
    public function setDateRecrutement($dateRecrutement)
    {
        $this->dateRecrutement = $dateRecrutement;

        return $this;
    }

    /**
     * Get dateRecrutement
     *
     * @return \DateTime
     */
    public function getDateRecrutement()
    {
        return $this->dateRecrutement;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Employe
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return Employe
     */
    public function setposte($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }
    /**
     * Set salaireDepart
     *
     * @param float $salaireDepart
     *
     * @return Employe
     */
    public function setSalaireDepart($salaireDepart)
    {
        $this->salaireDepart = $salaireDepart;

        return $this;
    }

    /**
     * Get salaireDepart
     *
     * @return float
     */
    public function getSalaireDepart()
    {
        return $this->salaireDepart;
    }

    /**
     * Set situationFamiliale
     *
     * @param string $situationFamiliale
     *
     * @return Employe
     */
    public function setSituationFamiliale($situationFamiliale)
    {
        $this->situationFamiliale = $situationFamiliale;

        return $this;
    }

    /**
     * Get situationFamiliale
     *
     * @return string
     */
    public function getSituationFamiliale()
    {
        return $this->situationFamiliale;
    }

    /**
     * Set enfantCharge
     *
     * @param integer $enfantCharge
     *
     * @return Employe
     */
    public function setEnfantCharge($enfantCharge)
    {
        $this->enfantCharge = $enfantCharge;

        return $this;
    }

    /**
     * Get enfantCharge
     *
     * @return int
     */
    public function getEnfantCharge()
    {
        return $this->enfantCharge;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Employe
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set mp
     *
     * @param string $mp
     *
     * @return Employe
     */
    public function setMp($mp)
    {
        $this->mp = $mp;

        return $this;
    }

    /**
     * Get mp
     *
     * @return string
     */
    public function getMp()
    {
        return $this->mp;
    }

    /**
     * Set admin
     *
     * @param boolean $admin
     *
     * @return Employe
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set matricule
     *
     * @param integer $matricule
     *
     * @return Employe
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return int
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set compteBancaire
     *
     * @param integer $compteBancaire
     *
     * @return Employe
     */
    public function setCompteBancaire($compteBancaire)
    {
        $this->compteBancaire = $compteBancaire;

        return $this;
    }

    /**
     * Get compteBancaire
     *
     * @return int
     */
    public function getCompteBancaire()
    {
        return $this->compteBancaire;
    }
}

