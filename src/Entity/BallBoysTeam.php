<?php

namespace App\Entity;

use App\Repository\BallBoysTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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

    public function __construct()
    {
        $this->ballBoys = new ArrayCollection();
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
        if (!$this->ballBoys->contains($ballBoy)) {
            $this->ballBoys[] = $ballBoy;
            $ballBoy->setBallBoysTeam($this);
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
}
