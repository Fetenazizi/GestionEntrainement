<?php

namespace App\Entity;

use App\Repository\EntrainementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use symfony\component\validator\constraints as Assert ;

#[ORM\Entity(repositoryClass: EntrainementsRepository::class)]
class Entrainements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $objectif = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\Column]
    private ?int $periode = null;

    #[ORM\Column]
    #[Assert\LessThanOrEqual(value: 60, message: "La durée ne peut pas dépasser 60.")]
    private ?int $duree = null;
    

    #[ORM\Column(length: 255)]
    private ?string $nom_entrainement = null;

    #[ORM\ManyToMany(targetEntity: Exercices::class, inversedBy: 'entrainements')]
    private Collection $exercices;

    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjectif(): ?string
    {
        return $this->objectif;
    }

    public function setObjectif(string $objectif): static
    {
        $this->objectif = $objectif;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getPeriode(): ?int
    {
        return $this->periode;
    }

    public function setPeriode(int $periode): static
    {
        $this->periode = $periode;

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

    public function getNomEntrainement(): ?string
    {
        return $this->nom_entrainement;
    }

    public function setNomEntrainement(string $nom_entrainement): static
    {
        $this->nom_entrainement = $nom_entrainement;

        return $this;
    }

    /**
     * @return Collection<int, Exercices>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercices $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
        }

        return $this;
    }

    public function removeExercice(Exercices $exercice): static
    {
        $this->exercices->removeElement($exercice);

        return $this;
    }
}
