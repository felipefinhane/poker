<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PartidaUsuarios {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_usuario;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_partida;

    /**
     * @ORM\Column(type="integer")
     */
    private $posicao;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_usuario_carrasco;

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getIdPartida() {
        return $this->id_partida;
    }

    public function getPosicao() {
        return $this->posicao;
    }

    public function getIdUsuarioCarrasco() {
        return $this->id_usuario_carrasco;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function setIdPartida($id_partida) {
        $this->id_partida = $id_partida;
        return $this;
    }

    public function setPosicao($posicao) {
        $this->posicao = $posicao;
        return $this;
    }

    public function setIdUsuarioCarrasco($id_usuario_carrasco) {
        $this->id_usuario_carrasco = $id_usuario_carrasco;
        return $this;
    }

}
