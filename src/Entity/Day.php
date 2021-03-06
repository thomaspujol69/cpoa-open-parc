<?php

namespace App\Entity;

use App\Repository\DayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DayRepository::class)
 */
class Day
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $begining;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="day")
     */
    private $games;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="day")
     */
    private $tickets;

    /**
     * @ORM\Column(type="integer")
     */
    private $cat1Price;

    /**
     * @ORM\Column(type="integer")
     */
    private $cat2Price;

    /**
     * @ORM\Column(type="integer")
     */
    private $cat1DispPl;

    /**
     * @ORM\Column(type="integer")
     */
    private $cat2DispPl;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBegining(): ?\DateTimeInterface
    {
        return $this->begining;
    }

    public function setBegining(\DateTimeInterface $begining): self
    {
        $this->begining = $begining;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $game->setDay($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getDay() === $this) {
                $game->setDay(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setDay($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getDay() === $this) {
                $ticket->setDay(null);
            }
        }

        return $this;
    }

    public function getCat1Price(): ?int
    {
        return $this->cat1Price;
    }

    public function setCat1Price(int $cat1Price): self
    {
        $this->cat1Price = $cat1Price;

        return $this;
    }

    public function getCat2Price(): ?int
    {
        return $this->cat2Price;
    }

    public function setCat2Price(int $cat2Price): self
    {
        $this->cat2Price = $cat2Price;

        return $this;
    }

    public function __toString()
    {
        return (date_format($this->date, 'd/m/Y'));
    }

    public function getCat1DispPl(): ?int
    {
        return $this->cat1DispPl;
    }

    public function setCat1DispPl(int $cat1DispPl): self
    {
        $this->cat1DispPl = $cat1DispPl;

        return $this;
    }

    public function getCat2DispPl(): ?int
    {
        return $this->cat2DispPl;
    }

    public function setCat2DispPl(int $cat2DispPl): self
    {
        $this->cat2DispPl = $cat2DispPl;

        return $this;
    }
}
