<?php

namespace App\Entity;

use App\Repository\EtablissementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementsRepository::class)]
class Etablissements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $est_foodtruck = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $distance = null;

    #[ORM\Column]
    private ?bool $est_ouvert = null;

    /**
     * @var Collection<int, Favoris>
     */
    #[ORM\OneToMany(targetEntity: Favoris::class, mappedBy: 'etablissement', orphanRemoval: true)]
    private Collection $favoris;

    /**
     * @var Collection<int, Jours>
     */
    #[ORM\OneToMany(targetEntity: Jours::class, mappedBy: 'etablissement')]
    private Collection $jours;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'etablissement', orphanRemoval: true)]
    private Collection $avis;

    /**
     * @var Collection<int, Evenements>
     */
    #[ORM\OneToMany(targetEntity: Evenements::class, mappedBy: 'etablissement', orphanRemoval: true)]
    private Collection $evenements;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->jours = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->evenements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEstFoodtruck(): ?bool
    {
        return $this->est_foodtruck;
    }

    public function setEstFoodtruck(bool $est_foodtruck): static
    {
        $this->est_foodtruck = $est_foodtruck;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function isEstOuvert(): ?bool
    {
        return $this->est_ouvert;
    }

    public function setEstOuvert(bool $est_ouvert): static
    {
        $this->est_ouvert = $est_ouvert;

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): static
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setEtablissement($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): static
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getEtablissement() === $this) {
                $favori->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jours>
     */
    public function getJours(): Collection
    {
        return $this->jours;
    }

    public function addJour(Jours $jour): static
    {
        if (!$this->jours->contains($jour)) {
            $this->jours->add($jour);
            $jour->setEtablissement($this);
        }

        return $this;
    }

    public function removeJour(Jours $jour): static
    {
        if ($this->jours->removeElement($jour)) {
            // set the owning side to null (unless already changed)
            if ($jour->getEtablissement() === $this) {
                $jour->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
            $avi->setEtablissement($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getEtablissement() === $this) {
                $avi->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evenements>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenements $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setEtablissement($this);
        }

        return $this;
    }

    public function removeEvenement(Evenements $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getEtablissement() === $this) {
                $evenement->setEtablissement(null);
            }
        }

        return $this;
    }
}
