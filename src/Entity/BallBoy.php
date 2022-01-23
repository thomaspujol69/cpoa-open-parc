<?php

namespace App\Entity;

use App\Repository\BallBoyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BallBoyRepository::class)
 */
class BallBoy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="ballBoys")
     */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity=BallBoysTeam::class, inversedBy="ballBoys")
     */
    private $ballBoysTeam;

    public function __construct()
    {
        $this->game = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGame(): Collection
    {
        return $this->game;
    }

    public function addGame(Game $game): self
    {
        if (!$this->game->contains($game)) {
            $this->game[] = $game;
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        $this->game->removeElement($game);

        return $this;
    }

    public function __toString()
    {
        return ($this->id.' '.$this->name);
    }

    public function getBallBoysTeam(): ?BallBoysTeam
    {
        return $this->ballBoysTeam;
    }

    public function setBallBoysTeam(?BallBoysTeam $ballBoysTeam): self
    {
        $this->ballBoysTeam = $ballBoysTeam;

        return $this;
    }
}
