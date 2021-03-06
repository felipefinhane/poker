<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Application\Entity\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
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

  /**
   * @ORM\Column(type="integer", length=1)
   */
  private $status;

  /**
   * @ORM\OneToMany(targetEntity="Application\Entity\CampeonatoUsuario", mappedBy="usuario")
   */
  private $campeonato_usuario;

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
    $this->senha = sha1($senha);
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

  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function getCampeonatoUsuario() {
    return $this->campeonato_usuario;
  }

  public function setCampeonatoUsuario($campeonato_usuario) {
    $this->campeonato_usuario = $campeonato_usuario;
  }

  public function getArrayCopy() {
    return [
      'id_usuario' => $this->id_usuario,
      'nome' => $this->nome,
      'email' => $this->email,
      'telefone' => $this->telefone,
      'senha' => $this->senha,
      'status' => $this->status, s
    ];
  }

}
