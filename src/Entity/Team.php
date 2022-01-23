<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="team")
     */
    private $players;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, mappedBy="teams")
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="teamWinner")
     */
    private $gamesWinner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isWomen;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->gamesWinner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
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
            $game->addTeam($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            $game->removeTeam($this);
        }

        return $this;
    }

    public function __toString()
    {
      //  return "";
        if (!is_null($this->players[0]) && !is_null($this->players[1])){
            return ($this->players[0]->getLastName().' '.$this->players[1]->getLastName());
        } else {
            return ("l'équipe manque de joueurs");
        }
    }
    public function getPlayerOne(){
        return $this->players[0];
    }
    public function getPlayerTwo(){
        return $this->players[1];
    }

    /**
     * @return Collection|Game[]
     */
    public function getGamesWinner(): Collection
    {
        return $this->gamesWinner;
    }

    public function addGamesWinner(Game $gamesWinner): self
    {
        if (!$this->gamesWinner->contains($gamesWinner)) {
            $this->gamesWinner[] = $gamesWinner;
            $gamesWinner->setTeamWinner($this);
        }

        return $this;
    }

    public function removeGamesWinner(Game $gamesWinner): self
    {
        if ($this->gamesWinner->removeElement($gamesWinner)) {
            // set the owning side to null (unless already changed)
            if ($gamesWinner->getTeamWinner() === $this) {
                $gamesWinner->setTeamWinner(null);
            }
        }

        return $this;
    }

    public function getIsWomen(): ?bool
    {
        return $this->isWomen;
    }

    public function setIsWomen(bool $isWomen): self
    {
        $this->isWomen = $isWomen;

        return $this;
    }
}
