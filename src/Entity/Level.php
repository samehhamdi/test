<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\LevelRepository")
 */
class Level
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
     */
    private $titleFr;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Required")
     */
    private $descriptionFr;
    /**
     * @ORM\Column(type="integer")
     */
    private $grade;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Skill", inversedBy="levels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DisciplineSkillLevel", mappedBy="level")
     */
    private $levelsd;

    public function __construct()
    {
        $this->levelsd = new ArrayCollection();
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }


    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * @return Collection|DisciplineSkillLevel[]
     */
    public function getLevelsd(): Collection
    {
        return $this->levelsd;
    }

    public function addLevelsd(DisciplineSkillLevel $levelsd): self
    {
        if (!$this->levelsd->contains($levelsd)) {
            $this->levelsd[] = $levelsd;
            $levelsd->setLevel($this);
        }

        return $this;
    }

    public function removeLevelsd(DisciplineSkillLevel $levelsd): self
    {
        if ($this->levelsd->contains($levelsd)) {
            $this->levelsd->removeElement($levelsd);
            // set the owning side to null (unless already changed)
            if ($levelsd->getLevel() === $this) {
                $levelsd->setLevel(null);
            }
        }

        return $this;
    }

    public function getGrade(): ?int
    {
        return $this->grade;
    }

    public function setGrade(int $grade): self
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