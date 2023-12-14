<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank(message: "Le nom ne peut pas etre vide")]
    #[Assert\Length(
        min: 5,
        max: 70,
        minMessage: "Le nom est trop court",
        maxMessage: "Le nom est trop long"
    )]

    private string $name;

    #[ORM\Column(type: "text")]
    /**
     * @Assert\NotBlank(message="La description ne peut pas etre vide")
     * @Assert\Length(
     *      min = 10,
     *      max = 300,
     *      minMessage = "La description  est trop courte",
     *      maxMessage = "La description est trop long",
     * )
     */
    private string $description;

    #[ORM\Column(type: "date")]
    /**
     * @Assert\NotBlank(message="Le nom ne peut pas etre vide")
     */
    private \DateTime $date;

    #[ORM\OneToMany(targetEntity: "App\Entity\Skill", mappedBy: "project")]
    private Collection $skills;


    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of skills
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set the value of skills
     *
     * @return  self
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }
}