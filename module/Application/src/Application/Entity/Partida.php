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

  /**
   * @ORM\OneToMany(targetEntity="Application\Entity\PartidaUsuarios", mappedBy="partida")
   */
  private $participantes;

  public function getIdPartida() {
    return $this->id_partida;
  }

  public function setData($data) {
    $data = \DateTime::createFromFormat('j/m/Y', $data);
    $this->data = new \DateTime(date('Y-m-d H:i:s', strtotime($data->format('Y-m-d'))));
    return $this;
  }

  public function getData() {
    return $this->data->format('d/m/Y');
  }

  public function getCampeonato() {
    return $this->campeonato;
  }

  public function setCampeonato($campeonato) {
    $this->campeonato = $campeonato;
    return $this;
  }


  public function getArrayCopy() {
    return [
      'id_partida' => $this->id_partida,
      'data'       => $this->getData()
    ];
  }


}
