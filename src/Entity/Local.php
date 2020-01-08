<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\LocalRepository")
 */
class Local
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $campus;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $bloco;

    /**
     * @ORM\Column(type="integer")
     */
    private $sala;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Agenda", mappedBy="local")
     */
    private $agendas;

    public function __construct()
    {
        $this->agendas = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampus(): ?string
    {
        return $this->campus;
    }

    public function setCampus(string $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    public function getBloco(): ?string
    {
        return $this->bloco;
    }

    public function setBloco(string $bloco): self
    {
        $this->bloco = $bloco;

        return $this;
    }

    public function getSala(): ?int
    {
        return $this->sala;
    }

    public function setSala(int $sala): self
    {
        $this->sala = $sala;

        return $this;
    }

    /**
     * @return Collection|Agenda[]
     */
    public function getAgendas(): Collection
    {
        return $this->agendas;
    }

    public function addAgenda(Agenda $agenda): self
    {
        if (!$this->agendas->contains($agenda)) {
            $this->agendas[] = $agenda;
            $agenda->setLocal($this);
        }

        return $this;
    }

    public function removeAgenda(Agenda $agenda): self
    {
        if ($this->agendas->contains($agenda)) {
            $this->agendas->removeElement($agenda);
            // set the owning side to null (unless already changed)
            if ($agenda->getLocal() === $this) {
                $agenda->setLocal(null);
            }
        }

        return $this;
    }


}
