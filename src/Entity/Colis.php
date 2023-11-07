<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRepository::class)]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroColis = null;

    #[ORM\Column]
    private ?int $poids = null;

    #[ORM\ManyToOne(inversedBy: 'lesColis')]
    private ?Commande $laCommande = null;

    #[ORM\OneToMany(mappedBy: 'leColis', targetEntity: Notification::class)]
    private Collection $lesNotifications;

    #[ORM\ManyToOne(inversedBy: 'lesColis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Casier $leCasier = null;

    public function __construct()
    {
        $this->lesNotifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroColis(): ?string
    {
        return $this->numeroColis;
    }

    public function setNumeroColis(string $NumeroColis): static
    {
        $this->numeroColis = $NumeroColis;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $Poids): static
    {
        $this->poids = $Poids;

        return $this;
    }

    public function getLaCommande(): ?Commande
    {
        return $this->laCommande;
    }

    public function setLaCommande(?Commande $laCommande): static
    {
        $this->laCommande = $laCommande;

        return $this;
    }

    /**
     * @return Collection<int, Notification>
     */
    public function getLesNotifications(): Collection
    {
        return $this->lesNotifications;
    }

    public function addLesNotification(Notification $lesNotification): static
    {
        if (!$this->lesNotifications->contains($lesNotification)) {
            $this->lesNotifications->add($lesNotification);
            $lesNotification->setLeColis($this);
        }

        return $this;
    }

    public function removeLesNotification(Notification $lesNotification): static
    {
        if ($this->lesNotifications->removeElement($lesNotification)) {
            // set the owning side to null (unless already changed)
            if ($lesNotification->getLeColis() === $this) {
                $lesNotification->setLeColis(null);
            }
        }

        return $this;
    }

    public function getLeCasier(): ?Casier
    {
        return $this->leCasier;
    }

    public function setLeCasier(?Casier $leCasier): static
    {
        $this->leCasier = $leCasier;

        return $this;
    }
}
