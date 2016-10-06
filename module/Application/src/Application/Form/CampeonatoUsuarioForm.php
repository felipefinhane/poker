<?php

namespace Application\Form;

use Zend\Form\Form;

class CampeonatoUsuarioForm extends Form{

    public function __construct() {
        parent::__construct('frmCampeonatoUsuario');

        $this->setAttribute('class', 'form-inline');

        //ID
        $this->add([
            'type' => 'Hidden',
            'name' => 'id_campeonato_usuario',
            'attributes' => [
                'id' => 'id_campeonato_usuario',
            ]
        ]);

        //Usuário
        $this->add([
            'type' => 'Text',
            'name' => 'id_usuario',
            'attributes' => [
                'class' => 'form-control autocomplete',
                'id' => 'id_usuario',
            ]
        ]);

        $this->add([
            'type' => 'Submit',
            'name' => 'btn_submit',
            'attributes' => [
                'value' => 'Adicionar',
                'class' => 'btn btn-primary',
                'id' => 'btn_submit',
            ]
        ]);

        $this->add([
            'type' => 'Button',
            'name' => 'btn_new',
            'attributes' => [
                'value' => 'Nova Usuário',
                'class' => 'btn btn-success',
                'id' => 'btn_new',
            ]
        ]);

        $this->add(new \Zend\Form\Element\Csrf('csrf'));
    }

}
