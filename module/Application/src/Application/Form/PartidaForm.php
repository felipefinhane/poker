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

        //Field Campeonato
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'campeonato',
            'options' => [
                'object_manager' => $entityManager,
                'target_class' => 'Application\Entity\Campeonato',
                'property' => 'titulo',
                'empty_option' => 'Escolha um campeonato'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        //Data Início
        $this->add([
            'type' => 'Date',
            'name' => 'data_inicio',
            'attributes' => [
                'class' => 'form-control datepicker',
                'id' => 'data_inicio',
            ]
        ]);

        //Data Fim
        $this->add([
            'type' => 'Date',
            'name' => 'data_fim',
            'attributes' => [
                'class' => 'form-control datepicker',
                'id' => 'data_fim',
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
