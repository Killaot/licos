<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NbrColis = null;



    #[ORM\ManyToOne(inversedBy: 'Commande')]
    private ?User $user = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrColis(): ?int
    {
        return $this->NbrColis;
    }

    public function setNbrColis(int $NbrColis): static
    {
        $this->NbrColis = $NbrColis;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

}