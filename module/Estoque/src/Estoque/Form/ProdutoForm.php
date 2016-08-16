<?php

namespace Estoque\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Doctrine\Common\Persistence\ObjectManager;

class ProdutoForm extends Form {
    
    public function __construct(ObjectManager $entityManager) {
        parent::__construct('formProduto');
        
        // Campo nome
        $this->add([
            'type' => 'Text',
            'name' => 'nome',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
 
        // Campo Preco
        $this->add([
            'type' => 'Number',
            'name' => 'preco',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
 
        // Campo Descricao
        $this->add([
            'type' => 'Textarea',
            'name' => 'descricao',
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
 
        // Botão Submit
        $this->add([
            'type' => 'Submit',
            'name' => 'btn_submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn btn-primary'
            ]
        ]);
        
        $this->add(new Element\Csrf('csrf'));
        
        
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'categoria',
            'options' => [
                'object_manager' => $entityManager,
                'target_class'=> 'Estoque\Entity\Categoria',
                'property' => 'descricao',
                'empty_option' => 'Escolha uma categoria'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);
    }
}