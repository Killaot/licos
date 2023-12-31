<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: VilleRepository::class)]
#[ApiResource]
class Ville
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column]
    private ?int $CodePostal = null;

    #[ORM\OneToMany(mappedBy: 'laVille', targetEntity: Relais::class)]
    private Collection $lesRelais;

    public function __construct()
    {
        $this->lesRelais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCodePostal(): ?int
    {
        return $this->CodePostal;
    }

    public function setCodePostal(int $CodePostal): static
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    /**
     * @return Collection<int, Relais>
     */
    public function getLesRelais(): Collection
    {
        return $this->lesRelais;
    }

    public function addLesRelai(Relais $lesRelai): static
    {
        if (!$this->lesRelais->contains($lesRelai)) {
            $this->lesRelais->add($lesRelai);
            $lesRelai->setLaVille($this);
        }

        return $this;
    }

    public function removeLesRelai(Relais $lesRelai): static
    {
        if ($this->lesRelais->removeElement($lesRelai)) {
            // set the owning side to null (unless already changed)
            if ($lesRelai->getLaVille() === $this) {
                $lesRelai->setLaVille(null);
            }
        }

        return $this;
    }
}
