<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Tel = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 255)]
    private ?string $MotDePasse = null;

    #[ORM\ManyToMany(targetEntity: Admin::class, mappedBy: 'lesClients')]
    private Collection $lesAdmins;

    public function __construct()
    {
        $this->laCommande = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->lesAdmins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

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

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(string $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->MotDePasse;
    }

    public function setMotDePasse(string $MotDePasse): static
    {
        $this->MotDePasse = $MotDePasse;

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
            $laCommande->setClient($this);
        }

        return $this;
    }

    public function removeLaCommande(Commande $laCommande): static
    {
        if ($this->laCommande->removeElement($laCommande)) {
            // set the owning side to null (unless already changed)
            if ($laCommande->getClient() === $this) {
                $laCommande->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setLeClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
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
            $lesAdmin->removeLesClient($this);}
        }
    }