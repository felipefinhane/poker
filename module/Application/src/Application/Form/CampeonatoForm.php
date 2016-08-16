<?php

namespace Application\Form;

class CampeonatoForm extends \Zend\Form\Form{
    
    public function __construct() {
        parent::__construct('frmCampeonato');

        //ID
        $this->add([
            'type' => 'Hidden',
            'name' => 'id_campeonato',
            'attributes' => [
                'id' => 'id_campeonato',
            ]
        ]);
        
        
        //Título
        $this->add([
            'type' => 'Text',
            'name' => 'titulo',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'titulo',
            ]
        ]);
        
        //Descrição
        $this->add([
            'type' => 'Textarea',
            'name' => 'descricao',
            'attributes' => [
                'class' => 'form-control',
                'id' => 'descricao',
            ]
        ]);
        
        //Valor da Partida
        $this->add([
            'type' => 'Number',
            'name' => 'valor_partida',
            'attributes' => [
                'class' => 'form-control money',
                'id' => 'valor_partida',
            ]
        ]);
        
        //Porcentagem do Campeonato
        $this->add([
            'type' => 'Number',
            'name' => 'porcentagem_campeonato',
            'attributes' => [
                'class' => 'form-control percent',
                'id' => 'porcentagem_campeonato',
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