<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransportRepository")
 */
class Transport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDemande;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datePickup;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDelivery;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnvoiMail;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $typeDemande;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, nullable=true)
     */
    private $nombrePalettes;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, nullable=true)
     */
    private $nombreMetresPlancher;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule")
     * @ORM\JoinColumn(nullable=true)
     */
    private $typeVehicule;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $facture;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $numeroFacture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
     * @ORM\JoinColumn(nullable=true)
     */
    private $expediteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
     * @ORM\JoinColumn(nullable=true)
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     * @ORM\JoinColumn(nullable=true)
     */
    private $contactExpediteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact")
     * @ORM\JoinColumn(nullable=true)
     */
    private $contactDestinataire;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $numeroDemande;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $numeroLocasyst;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mailEnvoye = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $transportDone = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $transportCancelled = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $pickupTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deliveryTime;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $nombreColis;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDemande(): ?\DateTimeInterface
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTimeInterface $dateDemande): self
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getDatePickup(): ?\DateTimeInterface
    {
        return $this->datePickup;
    }

    public function setDatePickup(?\DateTimeInterface $datePickup): self
    {
        $this->datePickup = $datePickup;

        return $this;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->dateDelivery;
    }

    public function setDateDelivery(?\DateTimeInterface $dateDelivery): self
    {
        $this->dateDelivery = $dateDelivery;

        return $this;
    }

    public function getDateEnvoiMail(): ?\DateTimeInterface
    {
        return $this->dateEnvoiMail;
    }

    public function setDateEnvoiMail(?\DateTimeInterface $dateEnvoiMail): self
    {
        $this->dateEnvoiMail = $dateEnvoiMail;

        return $this;
    }

    public function getTypeDemande(): ?string
    {
        return $this->typeDemande;
    }

    public function setTypeDemande(string $type): self
    {
        $this->typeDemande = $type;

        return $this;
    }

    public function getNombrePalettes(): ?string
    {
        return $this->nombrePalettes;
    }

    public function setNombrePalettes(?string $nombrePalettes): self
    {
        $this->nombrePalettes = $nombrePalettes;

        return $this;
    }

    public function getNombreMetresPlancher(): ?string
    {
        return $this->nombreMetresPlancher;
    }

    public function setNombreMetresPlancher(?string $nombreMetresPlancher): self
    {
        $this->nombreMetresPlancher = $nombreMetresPlancher;

        return $this;
    }

    public function getTypeVehicule(): ?Vehicule
    {
        return $this->typeVehicule;
    }

    public function setTypeVehicule(?Vehicule $typeVehicule): self
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    public function getFacture(): ?bool
    {
        return $this->facture;
    }

    public function setFacture(?bool $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    public function setNumeroFacture(?string $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    public function getExpediteur(): ?Adresse
    {
        return $this->expediteur;
    }

    public function setExpediteur(?Adresse $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDestinataire(): ?Adresse
    {
        return $this->destinataire;
    }

    public function setDestinataire(?Adresse $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getContactExpediteur(): ?Contact
    {
        return $this->contactExpediteur;
    }

    public function setContactExpediteur(?Contact $contactExpediteur): self
    {
        $this->contactExpediteur = $contactExpediteur;

        return $this;
    }

    public function getContactDestinataire(): ?Contact
    {
        return $this->contactDestinataire;
    }

    public function setContactDestinataire(?Contact $contactDestinataire): self
    {
        $this->contactDestinataire = $contactDestinataire;

        return $this;
    }

    public function getNumeroDemande(): ?string
    {
        return $this->numeroDemande;
    }

    public function setNumeroDemande(?string $numeroDemande): self
    {
        $this->numeroDemande = $numeroDemande;

        return $this;
    }

    public function getNumeroLocasyst(): ?string
    {
        return $this->numeroLocasyst;
    }

    public function setNumeroLocasyst(?string $numeroLocasyst): self
    {
        $this->numeroLocasyst = $numeroLocasyst;

        return $this;
    }

    public function getMailEnvoye(): ?bool
    {
        return $this->mailEnvoye;
    }

    public function setMailEnvoye(?bool $mailEnvoye): self
    {
        $this->mailEnvoye = $mailEnvoye;

        return $this;
    }

    public function getTransportDone(): ?bool
    {
        return $this->transportDone;
    }

    public function setTransportDone(?bool $transportDone): self
    {
        $this->transportDone = $transportDone;

        return $this;
    }

    public function getTransportCancelled(): ?bool
    {
        return $this->transportCancelled;
    }

    public function setTransportCancelled(bool $transportCancelled): self
    {
        $this->transportCancelled = $transportCancelled;

        return $this;
    }

    public function getPickupTime(): ?\DateTimeInterface
    {
        return $this->pickupTime;
    }

    public function setPickupTime(?\DateTimeInterface $pickupTime): self
    {
        $this->pickupTime = $pickupTime;

        return $this;
    }

    public function getDeliveryTime(): ?bool
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(?bool $deliveryTime): self
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    public function getNombreColis(): ?string
    {
        return $this->nombreColis;
    }

    public function setNombreColis(?string $nombreColis): self
    {
        $this->nombreColis = $nombreColis;

        return $this;
    }

    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }


}
