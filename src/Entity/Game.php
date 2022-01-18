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

    /**
     * @ORM\ManyToMany(targetEntity=Team::class, inversedBy="games")
     */
    private $teams;

    /**
     * @ORM\ManyToOne(targetEntity=Day::class, inversedBy="games")
     */
    private $day;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDouble = False;

    public function __construct()
    {
        $this->lineArbitrators = new ArrayCollection();
        $this->ballBoys = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->teams = new ArrayCollection();
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
        if ($hour!="10h" && $hour!="12h" && $hour!="14h" && $hour!="16h"){
            throw new Exception ("L'horaire doit être : 10h, 12h, 14h ou 16h");
        } else {
            $this->hour = $hour;
        }

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
            if ($chairArbitrator->getNationality()==$this->teams[0]->getPLayerOne()->getNationality() || $chairArbitrator->getNationality()==$this->teams[0]->getPLayerTwo()->getNationality() ||$chairArbitrator->getNationality()==$this->teams[1]->getPLayerOne()->getNationality() || $chairArbitrator->getNationality()==$this->teams[1]->getPLayerTwo()->getNationality()){
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
        if (count($this->getLineArbitrators()) < 7 ){
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
     * @return Collection|BallBoy[]
     */
    public function getBallBoys(): Collection
    {
        return $this->ballBoys;
    }

    public function addBallBoy(BallBoy $ballBoy): self
    {
        if (count($this->getBallBoys()) < 12 ){
            if (!$this->ballBoys->contains($ballBoy)) {
                $this->ballBoys[] = $ballBoy;
                $ballBoy->addGame($this);
            }
        } else {
            throw new Exception('Nombre de ballboy maximum atteint');
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

        return $this;
    }

    public function __toString()
    {
        return ($this->id.' '.$this->hour);
    }
}
