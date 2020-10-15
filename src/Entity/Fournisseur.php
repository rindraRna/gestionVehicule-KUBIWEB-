<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Marque::class, mappedBy="idFournisseur", cascade={"persist", "remove"})
     */
    private $fournisseur_marque;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFournisseurMarque(): ?Marque
    {
        return $this->fournisseur_marque;
    }

    public function setFournisseurMarque(Marque $fournisseur_marque): self
    {
        $this->fournisseur_marque = $fournisseur_marque;

        // set the owning side of the relation if necessary
        if ($fournisseur_marque->getIdFournisseur() !== $this) {
            $fournisseur_marque->setIdFournisseur($this);
        }

        return $this;
    }
}
