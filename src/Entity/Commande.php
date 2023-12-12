<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Colis;

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

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'laCommande', targetEntity: Colis::class)]
    private Collection $lesColis;

    public function __construct()
    {
        $this->lesColis = new ArrayCollection();
    }

    /**
     * @return Collection<int, Colis>
     */
    public function getLesColis(): Collection
    {
        return $this->lesColis;
    }

    public function addLeColis(Colis $leColis): static
    {
        if (!$this->lesColis->contains($leColis)) {
            $this->lesColis->add($leColis);
            $leColis->setLaCommande($this);
        }

        return $this;
    }

    public function removeLeColis(Colis $leColis): static
    {
        if ($this->lesColis->removeElement($leColis)) {
            // set the owning side to null (unless already changed)
            if ($leColis->getLaCommande() === $this) {
                $leColis->setLaCommande(null);
            }
        }

        return $this;
    }
    
    // ...

    /**
     * @return Collection<int, Colis>
     */
    public function getColis(): Collection
    {
        return $this->lesColis;
    }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

}