<?php

namespace App\Entity;

use App\Repository\CasierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasierRepository::class)]
class Casier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'leCasier', targetEntity: Colis::class)]
    private Collection $lesColis;

    #[ORM\ManyToOne(inversedBy: 'lesCasiers')]
    private ?Relais $leRelais = null;

    public function __construct()
    {
        $this->lesColis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Colis>
     */
    public function getLesColis(): Collection
    {
        return $this->lesColis;
    }

    public function addLesColi(Colis $lesColi): static
    {
        if (!$this->lesColis->contains($lesColi)) {
            $this->lesColis->add($lesColi);
            $lesColi->setLeCasier($this);
        }

        return $this;
    }

    public function removeLesColi(Colis $lesColi): static
    {
        if ($this->lesColis->removeElement($lesColi)) {
            // set the owning side to null (unless already changed)
            if ($lesColi->getLeCasier() === $this) {
                $lesColi->setLeCasier(null);
            }
        }

        return $this;
    }

    public function getLeRelais(): ?Relais
    {
        return $this->leRelais;
    }

    public function setLeRelais(?Relais $leRelais): static
    {
        $this->leRelais = $leRelais;

        return $this;
    }
}
