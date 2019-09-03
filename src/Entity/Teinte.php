<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeinteRepository")
 */
class Teinte
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
    private $teinte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeinte(): ?string
    {
        return $this->teinte;
    }

    public function setTeinte(string $teinte): self
    {
        $this->teinte = $teinte;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }
}
