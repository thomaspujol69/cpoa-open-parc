<?php

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;
use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
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
    private $dateBooking;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hourBooking;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="booking")
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Court::class, inversedBy="bookings")
     */
    private $court;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateBooking(): ?\DateTimeInterface
    {
        return $this->dateBooking;
    }

    public function setDateBooking(\DateTimeInterface $dateBooking): self
    {
        $this->dateBooking = $dateBooking;

        return $this;
    }

    public function getHourBooking(): ?string
    {
        return $this->hourBooking;
    }

    public function setHourBooking(string $hourBooking): self
    {
        if ($hourBooking!="10h" && $hourBooking!="12h" && $hourBooking!="14h" && $hourBooking!="16h"){
            throw new Exception ("L'horaire doit être : 10h, 12h, 14h ou 16h");
        } else {
            $this->hourBooking = $hourBooking;
        }

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

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
