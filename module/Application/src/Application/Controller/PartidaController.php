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
    $idCampeonato = $this->params('idCampeonato');
    $pagina = $this->params()->fromRoute('page', 1);
    $qtdePorPagina = 6;
    $offset = ($pagina - 1) * $qtdePorPagina;

    $objPartidas = $this->objManager->getRepository("Application\Entity\Partida")->getPartidaPaginados($idCampeonato, $qtdePorPagina, $offset);
    $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $idCampeonato);

    $view_params = array(
      'qtdePorPagina' => $qtdePorPagina,
      'objCampeonato' => $objCampeonato,
      'objPartidas' => $objPartidas,
      'customUrl' => [
        'name' => 'partida_campeonato',
        'param' => ['idCampeonato' => $idCampeonato]
      ]
      );

    return new ViewModel($view_params);
  }

  public function newAction() {
    $idCampeonato = $this->params('idCampeonato');
    if(!is_null($idCampeonato)){
      $formPartida = new \Application\Form\PartidaForm($this->objManager);
      $request = $this->getRequest();

      $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $idCampeonato);
      $objCampeonatoParticipantes = $this->objManager->getRepository("Application\Entity\CampeonatoUsuario")->getCampeonatoUsuarios($idCampeonato);
      $objPartidas = null;

      $formPartida->bind($objCampeonato);
      if ($request->isPost()) {
        $data = $request->getPost("data");
        $objPartida = new \Application\Entity\Partida();
        $objPartida->setData($data);
        $objPartida->setCampeonato($objCampeonato);
        //INSERIR PARTICIPANTES
        $jsonParticipantes = $request->getPost("participantes");
        $arrParticipantes = json_decode($jsonParticipantes);

        foreach ($arrParticipantes as $i => $participante) {
          $objPartidaUsuarios = new \Application\Entity\PartidaUsuarios();
          $objCampeonatoParticipante = $this->objManager->find("Application\Entity\CampeonatoUsuario", $participante);
          $objPartidaUsuarios->setParticipante($objCampeonatoParticipante);
          $objPartidaUsuarios->setPartida($objPartida);
          $this->objManager->persist($objPartidaUsuarios);
        }
        $this->objManager->persist($objPartida);
        // flush the remaining objects
        $this->objManager->flush();
        $this->objManager->clear();
        //FIM INSERIR PARTICIPANTES

        $this->flashMessenger()->addSuccessMessage("Partida Salvo com sucesso!");
        return $this->redirect()->toRoute('partida_campeonato', ['idCampeonato' => $idCampeonato]);
      }
      $viewParams = array(
        'formPartida' => $formPartida,
        'objCampeonato' => $objCampeonato,
        'objCampeonatoParticipantes' => $objCampeonatoParticipantes,
        'objPartidas' => $objPartidas
      );
      return new ViewModel($viewParams);
    }
    throw new \Exception("Error Processing Request", 1);
  }

  /**
   * 
  */
  public function editAction() {
    $idCampeonato = $this->params('idCampeonato');
    $idPartida = $this->params('idPartida');
    if((!is_null($idCampeonato)) && (!is_null($idPartida))){
      $formPartida = new \Application\Form\PartidaForm($this->objManager);
      $request = $this->getRequest();

      $objPartidaParticipantes = $this->objManager->getRepository("Application\Entity\PartidaUsuarios")->getPartidaUsuarios($idPartida);
      foreach ($objPartidaParticipantes as $key => $obj) {
        $objPartida = $obj->getPartida();
        $objCampeonato = $obj->getPartida()->getCampeonato();
        $arrParticipantes[] = $obj->getParticipante()->getIdCampeonatoUsuario();
      }
      $objCampeonatoParticipantes = $this->objManager->getRepository("Application\Entity\CampeonatoUsuario")->getCampeonatoUsuarios($idCampeonato);

      $formPartida->bind($objCampeonato);
      if ($request->isPost()) {
        $data = $request->getPost("data");
        $objPartida = new \Application\Entity\Partida();
        $objPartida->setData($data);
        $objPartida->setCampeonato($objCampeonato);
        //INSERIR PARTICIPANTES
        $jsonParticipantes = $request->getPost("participantes");
        $arrParticipantes = json_decode($jsonParticipantes);

        foreach ($arrParticipantes as $i => $participante) {
          $objPartidaUsuarios = new \Application\Entity\PartidaUsuarios();
          $objCampeonatoParticipante = $this->objManager->find("Application\Entity\CampeonatoUsuario", $participante);
          $objPartidaUsuarios->setParticipante($objCampeonatoParticipante);
          $objPartidaUsuarios->setPartida($objPartida);
          $this->objManager->persist($objPartidaUsuarios);
        }
        $this->objManager->persist($objPartida);
        // flush the remaining objects
        $this->objManager->flush();
        $this->objManager->clear();
        //FIM INSERIR PARTICIPANTES

        $this->flashMessenger()->addSuccessMessage("Partida Salvo com sucesso!");
        return $this->redirect()->toRoute('partida_campeonato', ['idCampeonato' => $idCampeonato]);
      }
      $viewParams = array(
        'formPartida' => $formPartida,
        'objCampeonato' => $objCampeonato,
        'objCampeonatoParticipantes' => $objCampeonatoParticipantes,
        'objPartidaParticipantes' => $objPartidaParticipantes,
        'arrParticipantes' => $arrParticipantes
      );
      return new ViewModel($viewParams);
    }
    throw new \Exception("Error Processing Request", 1);
  }


  public function manageAction() {
    $idCampeonato = $this->params('idCampeonato');
    $idPartida = $this->params('idPartida');
    if((!is_null($idCampeonato)) && (!is_null($idPartida))){
      $objPartidaParticipantes = $this->objManager->getRepository("Application\Entity\PartidaUsuarios")->getPartidaUsuarios($idPartida);
      $request = $this->getRequest();
      // if ($request->isPost()) {
      //   $data = $request->getPost("data");
      //   $objPartida = new \Application\Entity\Partida();
      //   $objPartida->setData($data);
      //   $objPartida->setCampeonato($objCampeonato);
      //   //INSERIR PARTICIPANTES
      //   $jsonParticipantes = $request->getPost("participantes");
      //   $arrParticipantes = json_decode($jsonParticipantes);

      //   foreach ($arrParticipantes as $i => $participante) {
      //     $objPartidaUsuarios = new \Application\Entity\PartidaUsuarios();
      //     $objCampeonatoParticipante = $this->objManager->find("Application\Entity\CampeonatoUsuario", $participante);
      //     $objPartidaUsuarios->setParticipante($objCampeonatoParticipante);
      //     $objPartidaUsuarios->setPartida($objPartida);
      //     $this->objManager->persist($objPartidaUsuarios);
      //   }
      //   $this->objManager->persist($objPartida);
      //   // flush the remaining objects
      //   $this->objManager->flush();
      //   $this->objManager->clear();
      //   //FIM INSERIR PARTICIPANTES

      //   $this->flashMessenger()->addSuccessMessage("Partida Salvo com sucesso!");
      //   return $this->redirect()->toRoute('partida_campeonato', ['idCampeonato' => $idCampeonato]);
      // }
      $viewParams = array(
        // 'formPartidaParticipantes' => $formPartidaParticipantes,
        'objPartidaParticipantes' => $objPartidaParticipantes,
      );
      return new ViewModel($viewParams);
    }
    throw new \Exception("Error Processing Request", 1);
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

}
