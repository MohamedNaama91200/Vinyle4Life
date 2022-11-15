<?php

namespace App\Entity;

use App\Repository\StyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StyleRepository::class)
 */
class Style
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
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Style::class, inversedBy="subStyle")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Style::class, mappedBy="parent")
     */
    private $subStyle;

    /**
     * @ORM\ManyToMany(targetEntity=Objet::class, mappedBy="style")
     */
    private $objets;

    public function __construct()
    {
        $this->subStyle = new ArrayCollection();
        $this->objets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubStyle(): Collection
    {
        return $this->subStyle;
    }

    public function addSubStyle(self $subStyle): self
    {
        if (!$this->subStyle->contains($subStyle)) {
            $this->subStyle[] = $subStyle;
            $subStyle->setParent($this);
        }

        return $this;
    }

    public function removeSubStyle(self $subStyle): self
    {
        if ($this->subStyle->removeElement($subStyle)) {
            // set the owning side to null (unless already changed)
            if ($subStyle->getParent() === $this) {
                $subStyle->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $objet->addStyle($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            $objet->removeStyle($this);
        }

        return $this;
    }
    public function __toString() 
    {
        $s = '';
        $s .= $this->getLabel() .' '. $this->getDescription() .' ';

        return $s;
    }
}
