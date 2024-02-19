<?php

namespace App\Entity;

use App\Repository\TestttRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestttRepository::class)]
class Testtt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $aaaa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAaaa(): ?string
    {
        return $this->aaaa;
    }

    public function setAaaa(string $aaaa): static
    {
        $this->aaaa = $aaaa;

        return $this;
    }
}
