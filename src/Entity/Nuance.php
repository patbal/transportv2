<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NuanceRepository")
 */
class Nuance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\couleur", inversedBy="nuances")
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\teintes", inversedBy="nuances")
     */
    private $teinte;

    public function getCouleur(): ?couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTeinte(): ?teintes
    {
        return $this->teinte;
    }

    public function setTeinte(?teintes $teinte): self
    {
        $this->teinte = $teinte;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

}