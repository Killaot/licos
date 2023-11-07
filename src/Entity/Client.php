<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $motDePasse = null;

    #[ORM\ManyToMany(targetEntity: Admin::class, mappedBy: 'lesClients')]
    private Collection $lesAdmins;

    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'leClient')]
    private Collection $laCommande;

    public function __construct()
    {
        $this->laCommande = new ArrayCollection();
        $this->lesAdmins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->prenom = $Prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $Nom): static
    {
        $this->nom = $Nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $Telephone): static
    {
        $this->telephone = $Telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $Email): static
    {
        $this->email = $Email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $MotDePasse): static
    {
        $this->motDePasse = $MotDePasse;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getLaCommande(): Collection
    {
        return $this->laCommande;
    }

    public function addLaCommande(Commande $laCommande): static
    {
        if (!$this->laCommande->contains($laCommande)) {
            $this->laCommande->add($laCommande);
            $laCommande->setLeClient($this);
        }

        return $this;
    }

    public function removeLaCommande(Commande $laCommande): static
    {
        if ($this->laCommande->removeElement($laCommande)) {
            // set the owning side to null (unless already changed)
            if ($laCommande->getLeClient() === $this) {
                $laCommande->setLeClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->laCommande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->laCommande->contains($commande)) {
            $this->laCommande->add($commande);
            $commande->setLeClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->laCommande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLeClient() === $this) {
                $commande->setLeClient(null);
            }
        }

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
            $lesAdmin->addLesClient($this);
        }

        return $this;
    }

    public function removeLesAdmin(Admin $lesAdmin): static
    {
        if ($this->lesAdmins->removeElement($lesAdmin)) {
            $lesAdmin->removeLesClient($this);
        }
        
        return $this;
    }
}