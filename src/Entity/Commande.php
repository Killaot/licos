<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NbrColis = null;

    #[ORM\ManyToOne(inversedBy: 'laCommandes')]
    private ?Client $leClient = null;

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

    public function getLeClient(): ?Client
    {
        return $this->leClient;
    }

    public function setLeClient(?Client $leClient): static
    {
        $this->leClient = $leClient;

        return $this;
    }

}