<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AgendaRepository")
 */
class Agenda
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $cargo;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Local", inversedBy="agendas")
     */
    private $local;

    /**
     * @ORM\OneToMany(targetEntity=Contato::class, mappedBy="agenda")
     */
    private $contato;

    public function __construct()
    {
        $this->contato = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(?Local $local): self
    {
        $this->local = $local;

        return $this;
    }

    /**
     * @return Collection|Contato[]
     */
    public function getContato(): Collection
    {
        return $this->contato;
    }

    public function addContato(Contato $contato): self
    {
        if (!$this->contato->contains($contato)) {
            $this->contato[] = $contato;
            $contato->setAgenda($this);
        }

        return $this;
    }

    public function removeContato(Contato $contato): self
    {
        if ($this->contato->contains($contato)) {
            $this->contato->removeElement($contato);
            // set the owning side to null (unless already changed)
            if ($contato->getAgenda() === $this) {
                $contato->setAgenda(null);
            }
        }

        return $this;
    }
}
