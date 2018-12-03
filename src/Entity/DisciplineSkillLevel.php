<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\DisciplineSkillLevelRepository")
 */
class DisciplineSkillLevel
{


    /**
     * @ORM\Column(type="string", length=20)
     */
    private $importance;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $dateCreated;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Skill", inversedBy="skillsd")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Level", inversedBy="levelsd")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Discipline", inversedBy="disciplinesd")
     * @ORM\JoinColumn(nullable=false)
     */
    private $discipline;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImportance(): ?string
    {
        return $this->importance;
    }

    public function setImportance(string $importance): self
    {
        $this->importance = $importance;

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

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }
}
