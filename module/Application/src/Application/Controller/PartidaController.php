<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PartidaController extends AbstractActionController {

    private $objManager;

    public function __construct(\Doctrine\Common\Persistence\ObjectManager $objManager) {
        $this->objManager = $objManager;
        $this->layout()->setVariable('varController', 'partida');
    }

    public function indexAction() {
        $pagina = $this->params()->fromRoute('page', 1);
        $qtdePorPagina = 6;
        $offset = ($pagina - 1) * $qtdePorPagina;

        $objPartidas = $this->objManager->getRepository("Application\Entity\Partida")->getPartidaPaginados($qtdePorPagina, $offset);

        $view_params = array(
            'qtdePorPagina' => $qtdePorPagina,
            'objPartidas' => $objPartidas
        );

        return new ViewModel($view_params);
    }

    public function newAction() {
        $formPartida = new \Application\Form\PartidaForm($this->objManager);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $idCampeonato = $request->getPost("campeonato");
            $data_inicio = $request->getPost("data_inicio");
            $data_fim = $request->getPost("data_fim");

            $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $idCampeonato);

            $objPartida = new \Application\Entity\Partida();
            $objPartida->setCampeonato($objCampeonato);
            $objPartida->setDataInicio($data_inicio);
            $objPartida->setDataFim($data_fim);

            $this->objManager->persist($objPartida);
            $this->objManager->flush();

            $this->flashMessenger()->addSuccessMessage("Partida Salvo com sucesso!");

            return $this->redirect()->toRoute('padrao', ['controller' => 'partida']);
        }
        return new ViewModel(['formPartida' => $formPartida]);
    }

    public function removeAction() {
        $id = $this->params()->fromRoute("id", 0);
        if ($this->request->isPost()) {
            $id = $this->request->getPost("id_partida");
            $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id);
            $strTituloCampeonato = $objCampeonato->getTitulo();
            $this->objManager->remove($objCampeonato);
            $this->objManager->flush();

            $this->flashMessenger()->addWarningMessage("A partida  {$strTituloCampeonato} foi removido!");
            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato']);
        }
        $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id);
        return new ViewModel(['objCampeonato' => $objCampeonato]);
    }

    public function editAction() {
        $id = $this->params()->fromRoute("id", 0);
        $formCampeonato = new \Application\Form\CampeonatoForm();
        if ($this->request->isPost()) {
            $id = $this->request->getPost("id_campeonato");
            $titulo = $this->request->getPost("titulo");
            $descricao = $this->request->getPost("descricao");
            $valor_partida = $this->request->getPost("valor_partida");
            $porcentagem_campeonato = $this->request->getPost("porcentagem_campeonato");
            $data_inicio = $this->request->getPost("data_inicio");
            $data_fim = $this->request->getPost("data_fim");

            $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id);

            $objCampeonato->setTitulo($titulo);
            $objCampeonato->setDescricao($descricao);
            $objCampeonato->setValorPartida($valor_partida);
            $objCampeonato->setPorcentagemCampeonato($porcentagem_campeonato);
            $objCampeonato->setDataInicio($data_inicio);
            $objCampeonato->setDataFim($data_fim);

            $this->objManager->persist($objCampeonato);
            $this->objManager->flush();

            $this->flashMessenger()->addSuccessMessage("Alterações no Campeonato  foram salvas com sucesso!");

            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato']);
        }
        $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id);
        $formCampeonato->bind($objCampeonato);
        return new ViewModel(['formCampeonato' => $formCampeonato]);
    }

}
