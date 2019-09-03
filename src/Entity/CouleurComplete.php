<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouleurCompleteRepository")
 */
class CouleurComplete
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Couleur")
     */
    private $couleur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Teinte")
     */
    private $teinte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCouleurComplete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleur(): ?Couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTeinte(): ?Teinte
    {
        return $this->teinte;
    }

    public function setTeinte(?Teinte $teinte): self
    {
        $this->teinte = $teinte;

        return $this;
    }

    public function getNomCouleurComplete(): ?string
    {
        return $this->nomCouleurComplete;
    }

    public function setNomCouleurComplete(string $nomCouleurComplete): self
    {
        $this->nomCouleurComplete = $nomCouleurComplete;

        return $this;
    }
}
