<?php

namespace App\Entity;

use App\Repository\MailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailRepository::class)]
class Mail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $sujet = null;

    #[ORM\Column(length: 255)]
    private ?string $contenue = null;

    #[ORM\ManyToOne(inversedBy: 'mails')]
    private ?User $envoyeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getsujet(): ?string
    {
        return $this->sujet;
    }

    public function setsujet(string $sujet): static
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): static
    {
        $this->contenue = $contenue;

        return $this;
    }

    public function getEnvoyeur(): ?User
    {
        return $this->envoyeur;
    }

    public function setEnvoyeur(?User $envoyeur): static
    {
        $this->envoyeur = $envoyeur;

        return $this;
    }
}
