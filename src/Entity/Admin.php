<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Relais::class, mappedBy: 'lesAdmins')]
    private Collection $lesRelais;

    #[ORM\ManyToMany(targetEntity: Client::class, inversedBy: 'lesAdmins')]
    private Collection $lesClients;

    public function __construct()
    {
        $this->lesRelais = new ArrayCollection();
        $this->lesClients = new ArrayCollection();
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
     * @return Collection<int, Client>
     */
    public function getLesClients(): Collection
    {
        return $this->lesClients;
    }

    public function addLesClient(Client $lesClient): static
    {
        if (!$this->lesClients->contains($lesClient)) {
            $this->lesClients->add($lesClient);
        }

        return $this;
    }

    public function removeLesClient(Client $lesClient): static
    {
        $this->lesClients->removeElement($lesClient);

        return $this;
    }
}
