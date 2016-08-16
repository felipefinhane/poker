<?php

namespace Application\Form;

use Zend\Form\Form;

class CampeonatoPontuacaoForm extends Form{

    public function __construct() {
        parent::__construct('frmCampeonatoPontuacao');

        $this->setAttribute('class', 'form-inline');

        //ID
        $this->add([
            'type' => 'Hidden',
            'name' => 'id_campeonato_pontuacao',
            'attributes' => [
                'id' => 'id_campeonato_pontuacao',
            ]
        ]);

        //Posicao
        $this->add([
            'type' => 'Number',
            'name' => 'posicao',
            'attributes' => [
                'readonly' => true,
                'class' => 'form-control',
                'id' => 'posicao',
            ]
        ]);

        //Valor da Pontuaçãos
        $this->add([
            'type' => 'Number',
            'name' => 'valor_pontuacao',
            'attributes' => [
                'class' => 'form-control money',
                'id' => 'valor_pontuacao',
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
                'value' => 'Nova Pontuação',
                'class' => 'btn btn-success',
                'id' => 'btn_new',
            ]
        ]);

        $this->add(new \Zend\Form\Element\Csrf('csrf'));
    }

}
