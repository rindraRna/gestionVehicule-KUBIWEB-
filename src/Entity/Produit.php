<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
* @ApiResource()
* @ORM\Entity(repositoryClass=ProduitRepository::class)
*/
class Produit
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteEnStock;


    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="produits", cascade={"refresh"} )
     */
    private $idMarque;

    /**
     * @ORM\OneToMany(targetEntity=DetailsCommande::class, mappedBy="idProduit")
     */
    private $detailsCommandes;

    public function __construct()
    {
        $this->detailsCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantiteEnStock(): ?int
    {
        return $this->quantiteEnStock;
    }

    public function setQuantiteEnStock(int $quantiteEnStock): self
    {
        $this->quantiteEnStock = $quantiteEnStock;

        return $this;
    }

    /**
     * @return Collection|Marque[]
     */
    public function getIdMarque(): Collection
    {
        return $this->idMarque;
    }

    // public function addIdMarque(Marque $idMarque): self
    // {
    //     if (!$this->idMarque->contains($idMarque)) {
    //         $this->idMarque[] = $idMarque;
    //         $idMarque->setMarqueProduit($this);
    //     }

    //     return $this;
    // }

    // public function removeIdMarque(Marque $idMarque): self
    // {
    //     if ($this->idMarque->contains($idMarque)) {
    //         $this->idMarque->removeElement($idMarque);
    //         // set the owning side to null (unless already changed)
    //         if ($idMarque->getMarqueProduit() === $this) {
    //             $idMarque->setMarqueProduit(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getProduitDetailsCommande(): ?DetailsCommande
    {
        return $this->produit_detailsCommande;
    }

    public function setProduitDetailsCommande(?DetailsCommande $produit_detailsCommande): self
    {
        $this->produit_detailsCommande = $produit_detailsCommande;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function setIdMarque(?Marque $idMarque): self
    {
        $this->idMarque = $idMarque;

        return $this;
    }

    /**
     * @return Collection|DetailsCommande[]
     */
    public function getDetailsCommandes(): Collection
    {
        return $this->detailsCommandes;
    }

    public function addDetailsCommande(DetailsCommande $detailsCommande): self
    {
        if (!$this->detailsCommandes->contains($detailsCommande)) {
            $this->detailsCommandes[] = $detailsCommande;
            $detailsCommande->setIdProduit($this);
        }

        return $this;
    }

    public function removeDetailsCommande(DetailsCommande $detailsCommande): self
    {
        if ($this->detailsCommandes->contains($detailsCommande)) {
            $this->detailsCommandes->removeElement($detailsCommande);
            // set the owning side to null (unless already changed)
            if ($detailsCommande->getIdProduit() === $this) {
                $detailsCommande->setIdProduit(null);
            }
        }

        return $this;
    }
}
