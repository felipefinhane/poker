<?php

namespace Estoque\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Usuario {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id_usuario;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $senha;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $telefone;

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
        return $this;
    }

    public function getTelefone() {
        return $this->telefone;
    }

}
