<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinal;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $score;

    /**
     * @ORM\ManyToOne(targetEntity=Arbitrator::class, inversedBy="chairGame")
     */
    private $chairArbitrator;

    /**
     * @ORM\ManyToMany(targetEntity=Arbitrator::class, mappedBy="lineGame")
     */
    private $lineArbitrators;

    /**
     * @ORM\ManyToMany(targetEntity=BallBoy::class, mappedBy="game")
     */
    private $ballBoys;

    /**
     * @ORM\ManyToMany(targetEntity=Player::class, mappedBy="game")
     */
    private $players;

    /**
     * @ORM\ManyToOne(targetEntity=Court::class, inversedBy="game")
     */
    private $court;

    public function __construct()
    {
        $this->lineArbitrators = new ArrayCollection();
        $this->ballBoys = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsFinal(): ?bool
    {
        return $this->isFinal;
    }

    public function setIsFinal(bool $isFinal): self
    {
        $this->isFinal = $isFinal;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getChairArbitrator(): ?Arbitrator
    {
        return $this->chairArbitrator;
    }

    public function setChairArbitrator(?Arbitrator $chairArbitrator): self
    {
        $this->chairArbitrator = $chairArbitrator;

        return $this;
    }

    /**
     * @return Collection|Arbitrator[]
     */
    public function getLineArbitrators(): Collection
    {
        return $this->lineArbitrators;
    }

    public function addLineArbitrator(Arbitrator $lineArbitrator): self
    {
        if (!$this->lineArbitrators->contains($lineArbitrator)) {
            $this->lineArbitrators[] = $lineArbitrator;
            $lineArbitrator->addLineGame($this);
        }

        return $this;
    }

    public function removeLineArbitrator(Arbitrator $lineArbitrator): self
    {
        if ($this->lineArbitrators->removeElement($lineArbitrator)) {
            $lineArbitrator->removeLineGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|BallBoy[]
     */
    public function getBallBoys(): Collection
    {
        return $this->ballBoys;
    }

    public function addBallBoy(BallBoy $ballBoy): self
    {
        if (!$this->ballBoys->contains($ballBoy)) {
            $this->ballBoys[] = $ballBoy;
            $ballBoy->addGame($this);
        }

        return $this;
    }

    public function removeBallBoy(BallBoy $ballBoy): self
    {
        if ($this->ballBoys->removeElement($ballBoy)) {
            $ballBoy->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->addGame($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            $player->removeGame($this);
        }

        return $this;
    }

    public function getCourt(): ?Court
    {
        return $this->court;
    }

    public function setCourt(?Court $court): self
    {
        $this->court = $court;

        return $this;
    }
}
