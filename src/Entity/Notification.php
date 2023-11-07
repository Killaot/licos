<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: NotificationRepository::class)]
#[ApiResource]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'lesNotifications')]
    private ?Colis $leColis = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeColis(): ?Colis
    {
        return $this->leColis;
    }

    public function setLeColis(?Colis $leColis): static
    {
        $this->leColis = $leColis;

        return $this;
    }
}
