<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="partida_usuarios")
 */
class PartidaUsuarios {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
  private $id_partida_usuario;

  /**
   * @ORM\ManyToOne(targetEntity="Partida", inversedBy="participantes")
   * @ORM\JoinColumn(name="id_partida",referencedColumnName="id_partida", nullable=false)
   */
  private $partida;

  /**
   * @ORM\ManyToOne(targetEntity="CampeonatoUsuario", inversedBy="partida_participante")
   * @ORM\JoinColumn(name="id_campeonato_usuario",referencedColumnName="id_usuario", nullable=false)
   */
  private $participante;

  /**
   * @ORM\Column(type="integer")
   */
  private $pago;

  /**
   * @ORM\Column(type="integer")
   */
  private $posicao;

  /**
   * @ORM\ManyToOne(targetEntity="CampeonatoUsuario", inversedBy="partida_carrasco")
   * @ORM\JoinColumn(name="id_campeonato_usuario",referencedColumnName="id_usuario_carrasco", nullable=true)
   */
  private $carrasco;
  public function getId_partida_usuario() {
    return $this->id_partida_usuario;
  }

  public function getId_partida() {
    return $this->id_partida;
  }

  public function getParticipante() {
    return $this->participante;
  }

  public function getPago() {
    return $this->pago;
  }

  public function getPosicao() {
    return $this->posicao;
  }

  public function getCarrasco() {
    return $this->carrasco;
  }

  public function setId_partida_usuario($id_partida_usuario) {
    $this->id_partida_usuario = $id_partida_usuario;
    return $this;
  }

  public function setId_partida($id_partida) {
    $this->id_partida = $id_partida;
    return $this;
  }

  public function setParticipante($participante) {
    $this->participante = $participante;
    return $this;
  }

  public function setPago($pago) {
    $this->pago = $pago;
    return $this;
  }

  public function setPosicao($posicao) {
    $this->posicao = $posicao;
    return $this;
  }

  public function setCarrasco($carrasco) {
    $this->carrasco = $carrasco;
    return $this;
  }


}
