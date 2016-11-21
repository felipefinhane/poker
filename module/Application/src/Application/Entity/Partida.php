<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\PartidaRepository")
 * @ORM\Table(name="partida")
 */
class Partida {

  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id_partida;

  /**
   * @ORM\Column(type="datetime")
   */
  private $data;

  /**
   * @ORM\ManyToOne(targetEntity="Application\Entity\Campeonato", inversedBy="partida")
   * @ORM\JoinColumn(name="id_campeonato",referencedColumnName="id_campeonato", nullable=false)
   */
  private $campeonato;

  public function getIdPartida() {
    return $this->id_partida;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $data = \DateTime::createFromFormat('j/m/Y', $data);
    $this->data = new \DateTime(date('Y-m-d H:i:s', strtotime($data->format('Y-m-d'))));
    return $this;
  }

  public function getCampeonato() {
    return $this->campeonato;
  }

  public function setCampeonato($campeonato) {
    $this->campeonato = $campeonato;
    return $this;
  }

}
