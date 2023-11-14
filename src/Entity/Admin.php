<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
#[ApiResource]
class Admin
{ //faire une relation avec User j'avais la flemme
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Relais::class, mappedBy: 'lesAdmins')]
    private Collection $lesRelais;



    public function __construct()
    {
        $this->lesRelais = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
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
            $lesRelai->addLesAdmin($this);
        }

        return $this;
    }

    public function removeLesRelai(Relais $lesRelai): static
    {
        if ($this->lesRelais->removeElement($lesRelai)) {
            $lesRelai->removeLesAdmin($this);
        }

        return $this;
    }

    
}
