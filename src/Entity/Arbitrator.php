<?php

namespace App\Entity;

use App\Repository\ArbitratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbSimpleMatchs;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbDoubleMatchs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="chairArbitrator")
     */
    private $chairGame;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="lineArbitrators")
     */
    private $lineGame;

    public function __construct()
    {
        $this->chairGame = new ArrayCollection();
        $this->lineGame = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getChairGame(): Collection
    {
        return $this->chairGame;
    }

    public function addChairGame(Game $chairGame): self
    {
        if (!$this->chairGame->contains($chairGame)) {
            $this->chairGame[] = $chairGame;
            $chairGame->setChairArbitrator($this);
        }

        return $this;
    }

    public function removeChairGame(Game $chairGame): self
    {
        if ($this->chairGame->removeElement($chairGame)) {
            // set the owning side to null (unless already changed)
            if ($chairGame->getChairArbitrator() === $this) {
                $chairGame->setChairArbitrator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getLineGame(): Collection
    {
        return $this->lineGame;
    }

    public function addLineGame(Game $lineGame): self
    {
        if (!$this->lineGame->contains($lineGame)) {
            $this->lineGame[] = $lineGame;
        }

        return $this;
    }

    public function removeLineGame(Game $lineGame): self
    {
        $this->lineGame->removeElement($lineGame);

        return $this;
    }

    public function __toString()
    {
        return ($this->id.' '.$this->name);
    }
}
