<?php

namespace ILANEO\CongeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AskVacation
 *
 * @ORM\Table(name="Ask_vacation")
 * @ORM\Entity(repositoryClass="ILANEO\CongeBundle\Repository\AskVacationRepository")
 */
class AskVacation
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
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="askDate", type="datetime")
     */
    private $askDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=20,nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pattern", type="string", length=255, nullable=true)
     */
    private $pattern;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Ajouter une fichier pdf")
     * @Assert\File(mimeTypes={ "application/pdf" })
     * @ORM\Column(name="supportingDoc", type="text", nullable=true)
     */
    private $supportingDoc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="typeVacation", type="string", length=50,nullable=true)
     */
    private $typeVacation;

    /**
     * @ORM\ManyToOne(targetEntity="AskVacation")
     */
    private $user;
    
    public function __construct()
    {
        $this->askDate = new \DateTime('now');
    }

    public function getUser()
    {
        return $this->user;
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startDate.
     *
     * @param \DateTime $startDate
     *
     * @return AskVacation
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate.
     *
     * @param \DateTime $endDate
     *
     * @return AskVacation
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }    

    /**
     * Set askDate.
     *
     * @param \DateTime $askDate
     *
     * @return AskVacation
     */
    public function setAskDate($askDate)
    {
        $this->askDate = $askDate;

        return $this;
    }

    /**
     * Get askDate.
     *
     * @return \DateTime
     */
    public function getAskDate()
    {
        return $this->askDate;
    }

    /**
     * Set state.
     *
     * @param string $state
     *
     * @return AskVacation
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set pattern.
     *
     * @param string|null $pattern
     *
     * @return AskVacation
     */
    public function setPattern($pattern = null)
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * Get pattern.
     *
     * @return string|null
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Set supportingDoc.
     *
     * @param string|null $supportingDoc
     *
     * @return AskVacation
     */
    public function setSupportingDoc($supportingDoc = null)
    {
        $this->supportingDoc = $supportingDoc;

        return $this;
    }

    /**
     * Get supportingDoc.
     *
     * @return string|null
     */
    public function getSupportingDoc()
    {
        return $this->supportingDoc;
    }

    /**
     * Set typeVacation.
     *
     * @param string $typeVacation
     *
     * @return AskVacation
     */
    public function setTypeVacation($typeVacation)
    {
        $this->typeVacation = $typeVacation;

        return $this;
    }

    /**
     * Get typeVacation.
     *
     * @return string
     */
    public function getTypeVacation()
    {
        return $this->typeVacation;
    }
    
}