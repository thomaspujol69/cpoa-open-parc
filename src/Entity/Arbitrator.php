<?php

namespace App\Entity;

use App\Repository\ArbitratorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArbitratorRepository::class)
 */
class Arbitrator
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbSimpleMatchs;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDoubleMatchs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isChair;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbSimpleMatchs(): ?int
    {
        return $this->nbSimpleMatchs;
    }

    public function setNbSimpleMatchs(int $nbSimpleMatchs): self
    {
        $this->nbSimpleMatchs = $nbSimpleMatchs;

        return $this;
    }

    public function getNbDoubleMatchs(): ?int
    {
        return $this->nbDoubleMatchs;
    }

    public function setNbDoubleMatchs(int $nbDoubleMatchs): self
    {
        $this->nbDoubleMatchs = $nbDoubleMatchs;

        return $this;
    }

    public function getIsChair(): ?bool
    {
        return $this->isChair;
    }

    public function setIsChair(bool $isChair): self
    {
        $this->isChair = $isChair;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }
}
