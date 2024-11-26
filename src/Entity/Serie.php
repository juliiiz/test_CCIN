<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateSortie = null;

    /**
     * @var Collection<int, Pokemon>
     */
    #[ORM\OneToMany(targetEntity: Pokemon::class, mappedBy: 'serie')]
    private Collection $carte;

    public function __construct()
    {
        $this->carte = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(?\DateTimeInterface $dateSortie): static
    {
        $this->dateSortie = $dateSortie;

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
            $carte->setSerie($this);
        }

        return $this;
    }

    public function removeCarte(Pokemon $carte): static
    {
        if ($this->carte->removeElement($carte)) {
            // set the owning side to null (unless already changed)
            if ($carte->getSerie() === $this) {
                $carte->setSerie(null);
            }
        }

        return $this;
    }
}
