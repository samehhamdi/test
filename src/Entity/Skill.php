<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     attributes={"formats"={"json", "json"={"application/json"}}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="skill.titleEn.required")
     */
    private $titleEn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionEn;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="skill.titleFr.required")
     */
    private $titleFr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionFr;
    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Required")
     */
    private $skilltype;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dateCreated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Level", mappedBy="skill",cascade={"persist"})
     */
    private $levels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DisciplineSkillLevel", mappedBy="skill")
     */
    private $skillsd;

    public function __construct()
    {
        $this->levels = new ArrayCollection();
        $this->skillsd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkilltype(): ?string
    {
        return $this->skilltype;
    }

    public function setSkilltype(string $skilltype): self
    {
        $this->skilltype = $skilltype;

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
     * @return Collection|Level[]
     */
    public function getLevels(): Collection
    {
        return $this->levels;
    }

    public function addLevel(Level $level): self
    {
        if (!$this->levels->contains($level)) {
            $this->levels[] = $level;
            $level->setSkill($this);
        }

        return $this;
    }

    public function removeLevel(Level $level): self
    {
        if ($this->levels->contains($level)) {
            $this->levels->removeElement($level);
            // set the owning side to null (unless already changed)
            if ($level->getSkill() === $this) {
                $level->setSkill(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DisciplineSkillLevel[]
     */
    public function getSkillsd(): Collection
    {
        return $this->skillsd;
    }

    public function addSkillsd(DisciplineSkillLevel $skillsd): self
    {
        if (!$this->skillsd->contains($skillsd)) {
            $this->skillsd[] = $skillsd;
            $skillsd->setSkill($this);
        }

        return $this;
    }

    public function removeSkillsd(DisciplineSkillLevel $skillsd): self
    {
        if ($this->skillsd->contains($skillsd)) {
            $this->skillsd->removeElement($skillsd);
            // set the owning side to null (unless already changed)
            if ($skillsd->getSkill() === $this) {
                $skillsd->setSkill(null);
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

    public function __toString()
    {
        return $this->getTitleEn();
    }
}
