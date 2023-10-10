<?php

namespace App\Entity;

use App\Repository\RelaisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelaisRepository::class)]
class Relais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NombreCasier = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\OneToMany(mappedBy: 'leRelais', targetEntity: Casier::class)]
    private Collection $lesCasier;

    #[ORM\ManyToOne(inversedBy: 'lesRelais')]
    private ?Ville $laVille = null;

    #[ORM\ManyToMany(targetEntity: Admin::class, inversedBy: 'lesRelais')]
    private Collection $lesAdmins;

    public function __construct()
    {
        $this->lesCasier = new ArrayCollection();
        $this->lesAdmins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreCasier(): ?string
    {
        return $this->NombreCasier;
    }

    public function setNombreCasier(string $NombreCasier): static
    {
        $this->NombreCasier = $NombreCasier;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, Casier>
     */
    public function getLesCasier(): Collection
    {
        return $this->lesCasier;
    }

    public function addLesCasier(Casier $lesCasier): static
    {
        if (!$this->lesCasier->contains($lesCasier)) {
            $this->lesCasier->add($lesCasier);
            $lesCasier->setLeRelais($this);
        }

        return $this;
    }

    public function removeLesCasier(Casier $lesCasier): static
    {
        if ($this->lesCasier->removeElement($lesCasier)) {
            // set the owning side to null (unless already changed)
            if ($lesCasier->getLeRelais() === $this) {
                $lesCasier->setLeRelais(null);
            }
        }

        return $this;
    }

    public function getLaVille(): ?Ville
    {
        return $this->laVille;
    }

    public function setLaVille(?Ville $laVille): static
    {
        $this->laVille = $laVille;

        return $this;
    }

    /**
     * @return Collection<int, Admin>
     */
    public function getLesAdmins(): Collection
    {
        return $this->lesAdmins;
    }

    public function addLesAdmin(Admin $lesAdmin): static
    {
        if (!$this->lesAdmins->contains($lesAdmin)) {
            $this->lesAdmins->add($lesAdmin);
        }

        return $this;
    }

    public function removeLesAdmin(Admin $lesAdmin): static
    {
        $this->lesAdmins->removeElement($lesAdmin);

        return $this;
    }
}
