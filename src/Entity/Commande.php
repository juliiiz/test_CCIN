<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'commande')]
    private Collection $carte;

    public function __construct()
    {
        $this->carte = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Pokemon>
     */
    public function getCarte(): Collection
    {
        return $this->carte;
    }

    public function addCarte(Pokemon $carte): static
    {
        if (!$this->carte->contains($carte)) {
            $this->carte->add($carte);
            $carte->setCommande($this);
        }

        return $this;
    }

    public function removeCarte(Pokemon $carte): static
    {
        if ($this->carte->removeElement($carte)) {
            // set the owning side to null (unless already changed)
            if ($carte->getCommande() === $this) {
                $carte->setCommande(null);
            }
        }

        return $this;
    }
}
