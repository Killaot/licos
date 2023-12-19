<?php

namespace App\Entity;

use App\Repository\RelaisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: RelaisRepository::class)]
#[ApiResource]
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
    private Collection $lesCasiers;

    #[ORM\ManyToOne(inversedBy: 'lesRelais')]
    private ?Ville $laVille = null;

    #[ORM\ManyToMany(targetEntity: Admin::class, inversedBy: 'lesRelais')]
    private Collection $lesAdmins;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?float $lat = null;

    #[ORM\Column]
    private ?float $lgn = null;

    #[ORM\OneToMany(mappedBy: 'leRelais', targetEntity: colis::class)]
    private Collection $leColis;

    public function __construct()
    {
        $this->lesCasiers = new ArrayCollection();
        $this->lesAdmins = new ArrayCollection();
        $this->leColis = new ArrayCollection();
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
        return $this->lesCasiers;
    }

    public function addLesCasier(Casier $lesCasier): static
    {
        if (!$this->lesCasiers->contains($lesCasier)) {
            $this->lesCasiers->add($lesCasier);
            $lesCasier->setLeRelais($this);
        }

        return $this;
    }

    public function removeLesCasier(Casier $lesCasier): static
    {
        if ($this->lesCasiers->removeElement($lesCasier)) {
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): static
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLgn(): ?float
    {
        return $this->lgn;
    }

    public function setLgn(float $lgn): static
    {
        $this->lgn = $lgn;

        return $this;
    }

    /**
     * @return Collection<int, colis>
     */
    public function getLeColis(): Collection
    {
        return $this->leColis;
    }

    public function addLeColi(colis $leColi): static
    {
        if (!$this->leColis->contains($leColi)) {
            $this->leColis->add($leColi);
            $leColi->setLeRelais($this);
        }

        return $this;
    }

    public function removeLeColi(colis $leColi): static
    {
        if ($this->leColis->removeElement($leColi)) {
            // set the owning side to null (unless already changed)
            if ($leColi->getLeRelais() === $this) {
                $leColi->setLeRelais(null);
            }
        }

        return $this;
    }
}
