<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransporteurRepository")
 */
class Transporteur
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $codepostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=22, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $coursier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $transporteur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $loueur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transport", mappedBy="transporteur")
     */
    private $transports;

    public function __construct()
    {
        $this->transports = new ArrayCollection();
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

    public function getAdresse1(): ?string
    {
        return $this->adresse1;
    }

    public function setAdresse1(?string $adresse1): self
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function setAdresse2(?string $adresse2): self
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    public function getCodepostal(): ?string
    {
        return $this->codepostal;
    }

    public function setCodepostal(?string $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCoursier(): ?bool
    {
        return $this->coursier;
    }

    public function setCoursier(?bool $coursier): self
    {
        $this->coursier = $coursier;

        return $this;
    }

    public function getTransporteur(): ?bool
    {
        return $this->transporteur;
    }

    public function setTransporteur(?bool $transporteur): self
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getLoueur(): ?bool
    {
        return $this->loueur;
    }

    public function setLoueur(?bool $loueur): self
    {
        $this->loueur = $loueur;

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setTransporteur($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->contains($transport)) {
            $this->transports->removeElement($transport);
            // set the owning side to null (unless already changed)
            if ($transport->getTransporteur() === $this) {
                $transport->setTransporteur(null);
            }
        }

        return $this;
    }
}
