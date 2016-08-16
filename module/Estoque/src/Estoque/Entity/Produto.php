<?php

namespace Estoque\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilter;

/**
 * @ORM\Entity(repositoryClass="\Estoque\Entity\Repository\ProdutoRepository") 
 */
class Produto implements InputFilterAwareInterface {

    /**
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $preco;

    /**
     * @ORM\Column(type="string")
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Estoque\Entity\Categoria", inversedBy="produto")
     * @ORM\JoinColumn(name="id_categoria",referencedColumnName="id", nullable=false)
     */
    private $categoria;

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new Exception('Você não deve invovar este método');
    }

    public function getInputFilter() {
        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'nome',
            'required' => true,
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 3,
                        'max' => 100,
                    ]
                ],
            ]
        ]);
        
        return $inputFilter;
    }

}
