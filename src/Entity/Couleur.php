<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CouleurRepository")
 */
class Couleur
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
    private $nomCouleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Teintes", mappedBy="couleur")
     */
    private $teintes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nuance", mappedBy="couleur")
     */
    private $teinte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nuance", mappedBy="couleur")
     */
    private $nuances;

    public function __construct()
    {
        $this->teintes = new ArrayCollection();
        $this->teinte = new ArrayCollection();
        $this->nuances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCouleur(): ?string
    {
        return $this->nomCouleur;
    }

    public function setNomCouleur(string $nomCouleur): self
    {
        $this->nomCouleur = $nomCouleur;

        return $this;
    }

    /**
     * @return Collection|Teintes[]
     */
    public function getTeintes(): Collection
    {
        return $this->teintes;
    }

    public function addTeinte(Teintes $teinte): self
    {
        if (!$this->teintes->contains($teinte)) {
            $this->teintes[] = $teinte;
            $teinte->setCouleur($this);
        }

        return $this;
    }

    public function removeTeinte(Teintes $teinte): self
    {
        if ($this->teintes->contains($teinte)) {
            $this->teintes->removeElement($teinte);
            // set the owning side to null (unless already changed)
            if ($teinte->getCouleur() === $this) {
                $teinte->setCouleur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Nuance[]
     */
    public function getTeinte(): Collection
    {
        return $this->teinte;
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
            $nuance->setCouleur($this);
        }

        return $this;
    }

    public function removeNuance(Nuance $nuance): self
    {
        if ($this->nuances->contains($nuance)) {
            $this->nuances->removeElement($nuance);
            // set the owning side to null (unless already changed)
            if ($nuance->getCouleur() === $this) {
                $nuance->setCouleur(null);
            }
        }

        return $this;
    }
}
