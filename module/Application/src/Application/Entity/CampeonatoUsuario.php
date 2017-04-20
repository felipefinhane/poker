<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="\Application\Entity\Repository\CampeonatoUsuarioRepository")
* @ORM\Table(name="campeonato_usuario")
*/
class CampeonatoUsuario
{

  /**
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  * @ORM\Column(type="integer")
  */
  private $id_campeonato_usuario;

  /**
  * @ORM\ManyToOne(targetEntity="Application\Entity\Usuario", inversedBy="campeonato_usuario")
  * @ORM\JoinColumn(name="id_usuario",referencedColumnName="id_usuario", nullable=false)
  */
  private $usuario;

  /**
  * @ORM\ManyToOne(targetEntity="Application\Entity\Campeonato", inversedBy="campeonato_usuario")
  * @ORM\JoinColumn(name="id_campeonato",referencedColumnName="id_campeonato", nullable=false)
  */
  private $campeonato;

  /**
  * @ORM\Column(type="integer")
  */
  private $administrador;
  /**
  * @ORM\Column(type="integer")
  */
  private $status;

  /**
   * @ORM\OneToMany(targetEntity="Application\Entity\PartidaUsuarios", mappedBy="participante")
   */
  private $partida_participante;

  /**
   * @ORM\OneToMany(targetEntity="Application\Entity\PartidaUsuarios", mappedBy="carrasco")
   */
  private $partida_carrasco;

  /**
  * @return mixed
  */
  public function getIdCampeonatoUsuario()
  {
    return $this->id_campeonato_usuario;
  }

  /**
  * @param mixed $id_campeonato_usuario
  * @return CampeonatoUsuario
  */
  public function setIdCampeonatoUsuario($id_campeonato_usuario)
  {
    $this->id_campeonato_usuario = $id_campeonato_usuario;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getUsuario()
  {
    return $this->usuario;
  }

  /**
  * @param mixed $usuario
  * @return CampeonatoUsuario
  */
  public function setUsuario(Usuario $usuario)
  {
    $this->usuario = $usuario;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getCampeonato()
  {
    return $this->campeonato;
  }

  /**
  * @param mixed $campeonato
  * @return CampeonatoUsuario
  */
  public function setCampeonato(Campeonato $campeonato)
  {
    $this->campeonato = $campeonato;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getAdministrador()
  {
    return $this->administrador;
  }

  /**
  * @param mixed $administrador
  * @return CampeonatoUsuario
  */
  public function setAdministrador($administrador)
  {
    $this->administrador = $administrador;
    return $this;
  }

  /**
  * @return mixed
  */
  public function getStatus()
  {
    return $this->status;
  }

  /**
  * @param mixed $status
  * @return CampeonatoUsuario
  */
  public function setStatus($status)
  {
    $this->status = $status;
    return $this;
  }

  /**
  * @return string
  */
  public function getStringTipo()
  {
    $strTipo = 'Participante';
    if($this->getAdministrador() == 1){
      $strTipo = 'Administrador';
    }
    return $strTipo;
  }

  /**
  * @return string
  */
  public function getStringStatus()
  {
    $strStatus = 'Inativo';
    if($this->getStatus() == 1){
      $strStatus = 'Ativo';
    }
    return $strStatus;
  }

  public function getPartidaParticipante(){
    return $this->partida_participante;
  }


  public function getArrayCopy(){
    return [
    'id_campeonato_usuario' => $this->id_campeonato_usuario,
    'usuario' => $this->usuario,
    'campeonato' => $this->campeonato,
    'administrador' => $this->administrador,
    'status' => $this->status,
    ];
  }

}
