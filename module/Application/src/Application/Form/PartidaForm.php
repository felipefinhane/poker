<?php

namespace Application\Form;

use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;

class PartidaForm extends Form {

    public function __construct(ObjectManager $entityManager) {
        parent::__construct('frmPartida');

        //Field id_partida
        $this->add([
            'type' => 'Hidden',
            'name' => 'id_partida'
        ]);

        //Field id_campeonato
        $this->add([
            'type' => 'Hidden',
            'name' => 'id_campeonato'
        ]);

        //Data Início
        $this->add([
            'type' => 'Date',
            'name' => 'data',
            'attributes' => [
                'class' => 'form-control datepicker',
                'id' => 'data',
            ]
        ]);

        //JSON DE PARTICIPANTES
        $this->add([
            'type' => 'Hidden',
            'name' => 'participantes',
            'attributes' => [
                'id' => 'participantes',
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
