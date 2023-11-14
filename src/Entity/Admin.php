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

    #[ORM\OneToMany(mappedBy: 'unAdmin', targetEntity: User::class)]
    private Collection $lesUsers;

    public function __construct()
    {
        $this->lesRelais = new ArrayCollection();
        $this->lesUsers = new ArrayCollection();

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

    /**
     * @return Collection<int, User>
     */
    public function getLesUsers(): Collection
    {
        return $this->lesUsers;
    }

    public function addLesUser(User $lesUser): static
    {
        if (!$this->lesUsers->contains($lesUser)) {
            $this->lesUsers->add($lesUser);
            $lesUser->setUnAdmin($this);
        }

        return $this;
    }

    public function removeLesUser(User $lesUser): static
    {
        if ($this->lesUsers->removeElement($lesUser)) {
            // set the owning side to null (unless already changed)
            if ($lesUser->getUnAdmin() === $this) {
                $lesUser->setUnAdmin(null);
            }
        }

        return $this;
    }

    
}
