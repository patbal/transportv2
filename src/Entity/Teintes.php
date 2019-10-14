<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeintesRepository")
 */
class Teintes
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
    private $nomTeinte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\couleur", inversedBy="teintes")
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nuance", mappedBy="teinte")
     */
    private $nuances;

    public function __construct()
    {
        $this->nuances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTeinte(): ?string
    {
        return $this->nomTeinte;
    }

    public function setNomTeinte(string $nomTeinte): self
    {
        $this->nomTeinte = $nomTeinte;

        return $this;
    }

    public function getCouleur(): ?couleur
    {
        return $this->couleur;
    }

    public function setCouleur(?couleur $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|Nuance[]
     */
    public function getNuances(): Collection
    {
        return $this->nuances;
    }

    public function addNuance(Nuance $nuance): self
    {
        if (!$this->nuances->contains($nuance)) {
            $this->nuances[] = $nuance;
            $nuance->setTeinte($this);
        }

        return $this;
    }

    public function removeNuance(Nuance $nuance): self
    {
        if ($this->nuances->contains($nuance)) {
            $this->nuances->removeElement($nuance);
            // set the owning side to null (unless already changed)
            if ($nuance->getTeinte() === $this) {
                $nuance->setTeinte(null);
            }
        }

        return $this;
    }
}
