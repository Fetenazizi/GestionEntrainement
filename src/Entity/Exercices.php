<?php

namespace App\Entity;

use App\Repository\ExercicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExercicesRepository::class)]
class Exercices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_exercice = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column]
    private ?int $nombres_de_fois = null;

    #[ORM\ManyToMany(targetEntity: Entrainements::class, mappedBy: 'exercices')]
    private Collection $entrainements;

    #[ORM\OneToMany(mappedBy: 'exercice', targetEntity: ReviewEx::class)]
    private Collection $reviews;

    public function __construct()       
    {
        $this->entrainements = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomExercice(): ?string
    {
        return $this->nom_exercice;
    }

    public function setNomExercice(string $nom_exercice): static
    {
        $this->nom_exercice = $nom_exercice;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNombresDeFois(): ?int
    {
        return $this->nombres_de_fois;
    }

    public function setNombresDeFois(int $nombres_de_fois): static
    {
        $this->nombres_de_fois = $nombres_de_fois;

        return $this;
    }

    /**
     * @return Collection<int, Entrainements>
     */
    public function getEntrainements(): Collection
    {
        return $this->entrainements;
    }

    public function addEntrainement(Entrainements $entrainement): static
    {
        if (!$this->entrainements->contains($entrainement)) {
            $this->entrainements->add($entrainement);
            $entrainement->addExercice($this);
        }

        return $this;
    }

    public function removeEntrainement(Entrainements $entrainement): static
    {
        if ($this->entrainements->removeElement($entrainement)) {
            $entrainement->removeExercice($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ReviewEx>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(ReviewEx $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setExercice($this);
        }

        return $this;
    }

    public function removeReview(ReviewEx $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getExercice() === $this) {
                $review->setExercice(null);
            }
        }

        return $this;
    }
}
