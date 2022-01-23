<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
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
    private $nationality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="players")
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="player")
     */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="players")
     */
    private $team;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="playerWinner")
     */
    private $gamesWinner;

    public function __construct()
    {
        $this->game = new ArrayCollection();
        $this->booking = new ArrayCollection();
        $this->gamesWinner = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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

    /**
     * @return Collection|Booking[]
     */
    public function getBooking(): Collection
    {
        return $this->booking;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->booking->contains($booking)) {
            $this->booking[] = $booking;
            $booking->setPlayer($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->booking->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getPlayer() === $this) {
                $booking->setPlayer(null);
            }
        }

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function __toString()
    {
        return ($this->firstName.' '.$this->lastName);
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
            $gamesWinner->setPlayerWinner($this);
        }

        return $this;
    }

    public function removeGamesWinner(Game $gamesWinner): self
    {
        if ($this->gamesWinner->removeElement($gamesWinner)) {
            // set the owning side to null (unless already changed)
            if ($gamesWinner->getPlayerWinner() === $this) {
                $gamesWinner->setPlayerWinner(null);
            }
        }

        return $this;
    }
}
