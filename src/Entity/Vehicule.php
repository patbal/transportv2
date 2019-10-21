<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $typevehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypevehicule(): ?string
    {
        return $this->typevehicule;
    }

    public function setTypevehicule(string $typevehicule): self
    {
        $this->typevehicule = $typevehicule;

        return $this;
    }
}
