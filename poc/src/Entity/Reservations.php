<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
// use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ReservationsRepository::class)]
// #[ApiResource()]
class Reservations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateResa = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Adherent $adherent = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Livre $livre = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateResa(): ?\DateTimeInterface
    {
        return $this->dateResa;
    }

    public function setDateResa(\DateTimeInterface $dateResa): static
    {
        $this->dateResa = $dateResa;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): static
    {
        $this->adherent = $adherent;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
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
}
