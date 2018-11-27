<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamilyRepository")
 */
class Family
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *
     */
    private $titleEn;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $descriptionEn;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *
     */
    private $titleFr;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $descriptionFr;
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime" , options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dateCreated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Discipline", mappedBy="family",cascade={"persist"})
     */
    private $disciplines;

    public function __construct()
    {
       // $this->disciplines = new ArrayCollection();
        $this->disciplines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return Collection|Discipline[]
     */
    public function getDisciplines(): Collection
    {
        return $this->disciplines;
    }

    public function addDisicplines(Discipline $ye): self
    {
        if (!$this->disciplines->contains($ye)) {
            $this->disciplines[] = $ye;
            $ye->setFamily($this);
        }

        return $this;
    }

    public function removeDisciplines(Discipline $ye): self
    {
        if ($this->disciplines->contains($ye)) {
            $this->disciplines->removeElement($ye);
            // set the owning side to null (unless already changed)
            if ($ye->getFamily() === $this) {
                $ye->setFamily(null);
            }
        }

        return $this;
    }

    public function addDiscipline(Discipline $discipline): self
    {
        if (!$this->disciplines->contains($discipline)) {
            $this->disciplines[] = $discipline;
            $discipline->setFamily($this);
        }

        return $this;
    }

    public function removeDiscipline(Discipline $discipline): self
    {
        if ($this->disciplines->contains($discipline)) {
            $this->disciplines->removeElement($discipline);
            // set the owning side to null (unless already changed)
            if ($discipline->getFamily() === $this) {
                $discipline->setFamily(null);
            }
        }

        return $this;
    }

    public function getTitleEn(): ?string
    {
        return $this->titleEn;
    }

    public function setTitleEn(string $titleEn): self
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(string $descriptionEn): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getTitleFr(): ?string
    {
        return $this->titleFr;
    }

    public function setTitleFr(string $titleFr): self
    {
        $this->titleFr = $titleFr;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->descriptionFr;
    }

    public function setDescriptionFr(string $descriptionFr): self
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

   

}
