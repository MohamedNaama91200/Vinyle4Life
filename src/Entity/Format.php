<?php

namespace App\Entity;

use App\Repository\FormatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormatRepository::class)
 */
class Format
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
     * @ORM\ManyToOne(targetEntity=Format::class, inversedBy="subFormat")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Format::class, mappedBy="parent")
     */
    private $subFormat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Format::class, inversedBy="subFormat1")
     */
    private $parent1;

    /**
     * @ORM\OneToMany(targetEntity=Format::class, mappedBy="parent1")
     */
    private $subFormat1;

    /**
     * @ORM\ManyToMany(targetEntity=Objet::class, mappedBy="format")
     */
    private $objets;

    public function __construct()
    {
        $this->subFormat = new ArrayCollection();
        $this->subFormat1 = new ArrayCollection();
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
    public function getSubFormat(): Collection
    {
        return $this->subFormat;
    }

    public function addSubFormat(self $subFormat): self
    {
        if (!$this->subFormat->contains($subFormat)) {
            $this->subFormat[] = $subFormat;
            $subFormat->setParent($this);
        }

        return $this;
    }

    public function removeSubFormat(self $subFormat): self
    {
        if ($this->subFormat->removeElement($subFormat)) {
            // set the owning side to null (unless already changed)
            if ($subFormat->getParent() === $this) {
                $subFormat->setParent(null);
            }
        }

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

    public function getParent1(): ?self
    {
        return $this->parent1;
    }

    public function setParent1(?self $parent1): self
    {
        $this->parent1 = $parent1;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSubFormat1(): Collection
    {
        return $this->subFormat1;
    }

    public function addSubFormat1(self $subFormat1): self
    {
        if (!$this->subFormat1->contains($subFormat1)) {
            $this->subFormat1[] = $subFormat1;
            $subFormat1->setParent1($this);
        }

        return $this;
    }

    public function removeSubFormat1(self $subFormat1): self
    {
        if ($this->subFormat1->removeElement($subFormat1)) {
            // set the owning side to null (unless already changed)
            if ($subFormat1->getParent1() === $this) {
                $subFormat1->setParent1(null);
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
            $objet->addFormat($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            $objet->removeFormat($this);
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
