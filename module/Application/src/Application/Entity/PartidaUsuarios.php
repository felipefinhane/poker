<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\PartidaUsuariosRepository")
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

  /**
  * @return mixed
  */
  public function getPartida() {
    return $this->partida;
  }

  public function setPartida($partida) {
    $this->partida = $partida;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getParticipante() {
    return $this->participante;
  }

  public function setParticipante($participante) {
    $this->participante = $participante;
    return $this;
  }

  public function getPago() {
    $varRetorno = 0;
    if($this->pago == 1){
      $varRetorno = 'SIM';
    }
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

  public function getArrayCopy(){
    return [
      'id_partida_usuario' => $this->id_partida_usuario,
      'partida' => $this->partida,
      'participante' => $this->participante,
      'pago' => $this->pago,
      'posicao' => $this->posicao,
      'carrasco' => $this->carrasco
    ];
  }

}
