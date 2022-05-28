<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
/**
 * @var \App\Entity\Note[] $notes
 */
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $typedeepreuve;

    #[ORM\Column(type: 'float')]
    private $moy;

    #[ORM\ManyToOne(targetEntity: Matieres::class, inversedBy: 'notes')]
    private $matieres;

    #[ORM\ManyToOne(targetEntity: Etudiants::class, inversedBy: 'notes')]
    private $etudiants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypedeepreuve(): ?string
    {
        return $this->typedeepreuve;
    }

    public function setTypedeepreuve(string $typedeepreuve): self
    {
        $this->typedeepreuve = $typedeepreuve;

        return $this;
    }

    public function getMoy(): ?float
    {
        return $this->moy;
    }

    public function setMoy(float $moy): self
    {
        $this->moy = $moy;

        return $this;
    }

    public function getMatieres(): ?Matieres
    {
        return $this->matieres;
    }

    public function setMatieres(?Matieres $matieres): self
    {
        $this->matieres = $matieres;

        return $this;
    }

    public function getEtudiants(): ?Etudiants
    {
        return $this->etudiants;
    }

    public function setEtudiants(?Etudiants $etudiants): self
    {
        $this->etudiants = $etudiants;

        return $this;
    }
}
