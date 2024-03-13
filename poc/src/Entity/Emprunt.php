<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

// use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: EmpruntRepository::class)]
// #[ApiResource()]
class Emprunt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['livre:read', 'livre:write', 'emprunt:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['livre:read', 'livre:write', 'emprunt:read', 'categorie:write'])]
    private ?\DateTimeInterface $dateEmprunt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['livre:read', 'livre:write', 'emprunt:read', 'categorie:write'])]
    private ?\DateTimeInterface $dateRetour = null;


    #[ORM\ManyToOne(inversedBy: 'emprunt')]
    private ?Livre $livre = null;

/**
     * @var Collection<int, Adherent>
     */
    private Collection $adherents;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    private ?Adherent $adherent = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $retard = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rendu = null;

    public function __construct()
    {
        $this->adherents = new ArrayCollection();
        $this->retard = "Non";
        $this->rendu = "Non";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->dateEmprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $dateEmprunt): static
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): static
    {
        $this->livre = $livre;

        return $this;
    }
    public function __toString()
    {
        return $this-> id;
    }

    public function getAdherent(): ?adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?adherent $adherent): static
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function getRetard(): ?string
    {
        return $this->retard;
    }

    public function setRetard(?string $retard): static
    {
        $this->retard = $retard;

        return $this;
    }

    public function getRendu(): ?string
    {
        return $this->rendu;
    }

    public function setRendu(?string $rendu): static
    {
        $this->rendu = $rendu;

        return $this;
    }
}
