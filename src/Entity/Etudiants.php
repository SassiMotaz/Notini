<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use App\Repository\EtudiantsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: EtudiantsRepository::class)]
class Etudiants
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $code_ins;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'integer')]
    private $cin;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $mdp;

  

    #[ORM\ManyToMany(targetEntity: Matieres::class, inversedBy: 'etudiants')]
    private $Matiers;

    #[ORM\OneToMany(mappedBy: 'etudiants', targetEntity: Note::class)]
    private $notes;

    public function __construct()
    {
        $this->Matiers = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }
    public function __toString(): string
    {
        return $this->nom;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeIns(): ?int
    {
        return $this->code_ins;
    }

    public function setCodeIns(int $code_ins): self
    {
        $this->code_ins = $code_ins;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * @return Collection<int, Matieres>
     */
    public function getMatiers(): Collection
    {
        return $this->Matiers;
    }

    public function addMatier(Matieres $matier): self
    {
        if (!$this->Matiers->contains($matier)) {
            $this->Matiers[] = $matier;
        }

        return $this;
    }

    public function removeMatier(Matieres $matier): self
    {
        $this->Matiers->removeElement($matier);

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEtudiants($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEtudiants() === $this) {
                $note->setEtudiants(null);
            }
        }

        return $this;
    }
}
