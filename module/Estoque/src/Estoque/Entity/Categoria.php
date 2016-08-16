<?php

namespace Estoque\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="\Estoque\Entity\Repository\CategoriaRepository") 
 */
class Categoria {

    /**
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120)
     */
    private $descricao;
    
    /**
     * @ORM\OneToMany(targetEntity="Estoque\Entity\Produto", mappedBy="categoria")
     */
    private $produto;

    public function __construct($descricao, $id = null) {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

}
