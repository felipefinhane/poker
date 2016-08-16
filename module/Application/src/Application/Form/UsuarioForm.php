<?php

namespace Application\Form;

class UsuarioForm extends \Zend\Form\Form{
    
    public function __construct() {
        parent::__construct('frmUsuario');

        //ID
        $this->add([
            'type' => 'Hidden',
            'name' => 'id_usuario',
            'attributes' => [
                'id' => 'id_usuario',
            ]
        ]);
        
        //Nome
        $this->add([
            'type' => 'Text',
            'name' => 'nome',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'nome',
            ]
        ]);
        
        //Email
        $this->add([
            'type' => 'Email',
            'name' => 'email',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'email',
            ]
        ]);
        
        //Telefone
        $this->add([
            'type' => 'Number',
            'name' => 'telefone',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'telefone',
            ]
        ]);
        
        //Senha
        $this->add([
            'type' => 'Password',
            'name' => 'senha',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'senha',
            ]
        ]);
        
        $this->add([
            'type' => 'Submit',
            'name' => 'btn_submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn btn-primary',
                'id' => 'btn_submit',
            ]
        ]);
        
        $this->add(new \Zend\Form\Element\Csrf('csrf'));
    }
}