<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="partida_usuario")
 */

class PartidaUsuarios {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
  private $id_partida_usuario;

  /**
   * @ORM\ManyToOne(targetEntity="Application\Entity\Partida", inversedBy="participantes")
   * @ORM\JoinColumn(name="id_partida",referencedColumnName="id_partida", nullable=false)
   */
  private $partida;

  /**
  * @ORM\ManyToOne(targetEntity="Application\Entity\CampeonatoUsuario", inversedBy="partida_participante")
  * @ORM\JoinColumn(name="id_campeonato_usuario",referencedColumnName="id_campeonato_usuario", nullable=false)
  */
  private $participante;

  /**
   * @ORM\Column(type="integer", options={"default"=0})
   */
  private $pago;

  /**
   * @ORM\Column(type="integer")
   */
  private $posicao;

  /**
  * @ORM\ManyToOne(targetEntity="Application\Entity\CampeonatoUsuario", inversedBy="partida_carrasco")
  * @ORM\JoinColumn(name="id_campeonato_usuario_carrasco",referencedColumnName="id_campeonato_usuario", nullable=true)
  */
  private $carrasco;

  public function getIdPartidaUsuario() {
    return $this->id_partida_usuario;
  }

  public function setIdPartidaUsuario($id_partida_usuario) {
    $this->id_partida_usuario = $id_partida_usuario;
    return $this;
  }

  public function getPartida() {
    return $this->partida;
  }

  public function setPartida($partida) {
    $this->partida = $partida;
    return $this;
  }

  public function getParticipante() {
    return $this->participante;
  }

  public function setParticipante($participante) {
    $this->participante = $participante;
    return $this;
  }

  public function getPago() {
    return $this->pago;
  }

  public function setPago($pago) {
    $this->pago = $pago;
    return $this;
  }

  public function getPosicao() {
    return $this->posicao;
  }

  public function setPosicao($posicao) {
    $this->posicao = $posicao;
    return $this;
  }

  public function getCarrasco() {
    return $this->carrasco;
  }

  public function setCarrasco($carrasco) {
    $this->carrasco = $carrasco;
    return $this;
  }

}
