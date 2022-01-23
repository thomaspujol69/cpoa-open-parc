<?php

namespace App\Entity;

use App\Repository\BallBoysTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * @ORM\Entity(repositoryClass=BallBoysTeamRepository::class)
 */
class BallBoysTeam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=BallBoy::class, mappedBy="ballBoysTeam")
     */
    private $ballBoys;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="ballBoysTeams")
     */
    private $games;

    public function __construct()
    {
        $this->ballBoys = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
        if (count($this->getBallBoys()) <6 ){
            if (!$this->ballBoys->contains($ballBoy)) {
                $this->ballBoys[] = $ballBoy;
                $ballBoy->setBallBoysTeam($this);
            }
        } else {
            throw new Exception ("seulement 6 ramasseurs par équipe !");
        }

        return $this;
    }

    public function removeBallBoy(BallBoy $ballBoy): self
    {
        if ($this->ballBoys->removeElement($ballBoy)) {
            // set the owning side to null (unless already changed)
            if ($ballBoy->getBallBoysTeam() === $this) {
                $ballBoy->setBallBoysTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        $this->games->removeElement($game);

        return $this;
    }

    public function __toString()
    {
        return ($this->id);
    }
}
