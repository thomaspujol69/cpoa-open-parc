<?php

namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;
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
     * @ORM\Column(type="string", length=255,nullable=true)
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
     * @ORM\ManyToMany(targetEntity=Player::class, mappedBy="game")
     */
    private $players;

    /**
     * @ORM\ManyToOne(targetEntity=Court::class, inversedBy="game")
     */
    private $court;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, inversedBy="games")
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity=Day::class, inversedBy="games")
     * @ORM\JoinColumn(name="day_id", referencedColumnName="id", nullable=false)
     */
    private $day;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDouble = False;

    /**
     * @ORM\ManyToMany(targetEntity=BallBoysTeam::class, mappedBy="games")
     */
    private $ballBoysTeams;

    public function __construct()
    {
        $this->lineArbitrators = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->ballBoysTeams = new ArrayCollection();
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
        
        if ($this->getIsFinal() && date("D",$date->getTimeStamp()) != "Sun"){
            throw new Exception ("La finale se fait forcément un dimanche");
        } else {
            $this->date = $date;
        }

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

    public function getIsDouble(): ?bool
    {
        return $this->isDouble;
    }

    public function setIsDouble(bool $isDouble): self
    {
        $this->isDouble = $isDouble;

        return $this;
    }

    public function getChairArbitrator(): ?Arbitrator
    {
        return $this->chairArbitrator;
    }

    public function setChairArbitrator(?Arbitrator $chairArbitrator): self
    {
        if($this->chairArbitrator != null){
            if (!$this->getIsDouble()){
                $this->chairArbitrator->setNbDoubleMatchs($this->chairArbitrator->getNbDoubleMatchs()-1);
            } else {
                $this->chairArbitrator->setNbSimpleMatchs($this->chairArbitrator->getNbSimpleMatchs()-1);
            }
        }

        
        if ($this->getIsDouble()){
            if ($chairArbitrator->getNationality()==$this->teams[0]->getPlayerOne()->getNationality() || $chairArbitrator->getNationality()==$this->teams[0]->getPlayerTwo()->getNationality() ||$chairArbitrator->getNationality()==$this->teams[1]->getPlayerOne()->getNationality() || $chairArbitrator->getNationality()==$this->teams[1]->getPlayerTwo()->getNationality()){
                throw new Exception ("la nationalité de l'arbitre doit différer de celles des joueurs");
            }
            else if ($chairArbitrator->getNbDoubleMatchs()<2){
                $chairArbitrator->setNbDoubleMatchs($chairArbitrator->getNbDoubleMatchs()+1);
                $this->chairArbitrator = $chairArbitrator;
            } else{
                throw new Exception ("cet arbitre a fait assez de double, laissez le dormir");
            }

        } else {
            if ($chairArbitrator->getNationality()==$this->players[0]->getNationality() || $chairArbitrator->getNationality()==$this->players[1]->getNationality()){
                throw new Exception ("la nationalité de l'arbitre doit différer de celles des joueurs");
            } else if ($chairArbitrator->getNbSimpleMatchs()<2){
                $chairArbitrator->setNbSimpleMatchs($chairArbitrator->getNbSimpleMatchs()+1);
                $this->chairArbitrator = $chairArbitrator;
            } else {
                throw new Exception ("il a fait assez de simple.");
            }

        }
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
        if ($lineArbitrator==$this->getChairArbitrator()){
            throw new Exception ("Ben voyons Timothé, un arbitre ne peut pas être à la fois de ligne et de chaise !!");
        }
        else if (count($this->getLineArbitrators()) < 7 ){
            if (!$this->lineArbitrators->contains($lineArbitrator)) {
                $this->lineArbitrators[] = $lineArbitrator;
                $lineArbitrator->addLineGame($this);
            }
        } else {
            throw new Exception ("Nombre Maximum d'arbitres de ligne atteints");
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
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if ($this->getIsDouble()){
            throw new Exception ("Un match double ne contient pas de joueurs seuls");
        } else{
            if (!$this->players->contains($player)) {
                $this->players[] = $player;
                $player->addGame($this);
            }
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
        if ($this->getIsFinal() && !$court->getIsMain()){
            throw new Exception ("le court de la finale doit être le cours principal");
        } else {
    
            $this->court = $court;
        }
        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if ((!$this->getIsDouble())){
            throw new Exception ("Impossible de mettre une équipe dans un match simple");           
        } else {
            if (count($this->getTeams())<2){
                if (!$this->teams->contains($team)) {
                    $this->teams[] = $team;
                }
            }
        }


        return $this;
    }

    public function removeTeam(Team $team): self
    {
        $this->teams->removeElement($team);

        return $this;
    }

    public function getDay(): ?Day
    {
        return $this->day;
    }

    public function setDay(?Day $day): self
    {
        $this->day = $day;
        $this->setDate($day->getDate());
        return $this;
    }

    public function __toString()
    {
        return ($this->id.' '.$this->hour);
    }

    /**
     * @return Collection|BallBoysTeam[]
     */
    public function getBallBoysTeams(): Collection
    {
        return $this->ballBoysTeams;
    }

    public function addBallBoysTeam(BallBoysTeam $ballBoysTeam): self
    {
        if (count($this->getBallBoysTeams()) < 2 ){
            if (!$this->ballBoysTeams->contains($ballBoysTeam)) {
                $this->ballBoysTeams[] = $ballBoysTeam;
                $ballBoysTeam->addGame($this);
            }
        } else {
            throw new Exception ("pas plus de deux équipes de ramasseurs, merci");
        }

        return $this;
    }

    public function removeBallBoysTeam(BallBoysTeam $ballBoysTeam): self
    {
        if ($this->ballBoysTeams->removeElement($ballBoysTeam)) {
            $ballBoysTeam->removeGame($this);
        }

        return $this;
    }
}
