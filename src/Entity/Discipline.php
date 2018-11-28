<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DisciplineRepository")
 */
class Discipline
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Required")
     *
     */
    private $titleEn;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Required")
     */
    private $descriptionEn;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Required")
     *
     */
    private $titleFr;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Required")
     */
    private $descriptionFr;
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;


    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Family", inversedBy="disciplines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $family;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DisciplineSkillLevel", mappedBy="discipline",cascade={"persist"})
     */
    private $disciplinesd;

    /**
     * @ORM\Column(type="json_array")
     */
    private $grade;

    public function __construct()
    {
        $this->disciplinesd = new ArrayCollection();
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

    public function getFamily(): ?Family
    {
        return $this->family;
    }

    public function setFamily(?Family $family): self
    {
        $this->family = $family;

        return $this;
    }

    /**
     * @return Collection|DisciplineSkillLevel[]
     */
    public function getDisciplinesd(): Collection
    {
        return $this->disciplinesd;
    }

    public function addDisciplinesd(DisciplineSkillLevel $disciplinesd): self
    {
        if (!$this->disciplinesd->contains($disciplinesd)) {
            $this->disciplinesd[] = $disciplinesd;
            $disciplinesd->setDiscipline($this);
        }

        return $this;
    }

    public function removeDisciplinesd(DisciplineSkillLevel $disciplinesd): self
    {
        if ($this->disciplinesd->contains($disciplinesd)) {
            $this->disciplinesd->removeElement($disciplinesd);
            // set the owning side to null (unless already changed)
            if ($disciplinesd->getDiscipline() === $this) {
                $disciplinesd->setDiscipline(null);
            }
        }

        return $this;
    }

    public function getGrade(): ?array
    {
        return $this->grade;
    }

    public function setGrade(array $grade): self
    {
        $this->grade = $grade;

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
