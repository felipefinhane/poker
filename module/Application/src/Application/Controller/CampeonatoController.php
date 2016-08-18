<?php

namespace Application\Controller;

use Application\Entity\CampeonatoPontuacao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CampeonatoController extends AbstractActionController
{

    private $objManager;

    public function __construct(\Doctrine\Common\Persistence\ObjectManager $objManager)
    {
        $this->objManager = $objManager;
        $this->layout()->setVariable('varController', 'campeonato');
    }

    public function indexAction()
    {
        $pagina = $this->params()->fromRoute('page', 1);
        $qtdePorPagina = 6;
        $offset = ($pagina - 1) * $qtdePorPagina;

        $objCampeonatos = $this->objManager->getRepository("Application\Entity\Campeonato")->getCampeonatoPaginados($qtdePorPagina, $offset);

        $view_params = array(
            'qtdePorPagina' => $qtdePorPagina,
            'objCampeonatos' => $objCampeonatos
        );

        return new ViewModel($view_params);
    }

    public function newAction()
    {
        $formCampeonato = new \Application\Form\CampeonatoForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $titulo = $request->getPost("titulo");
            $descricao = $request->getPost("descricao");
            $valor_partida = $request->getPost("valor_partida");
            $porcentagem_campeonato = $request->getPost("porcentagem_campeonato");
            $data_inicio = $request->getPost("data_inicio");
            $data_fim = $request->getPost("data_fim");

            $objCampeonato = new \Application\Entity\Campeonato();
            $objCampeonato->setTitulo($titulo);
            $objCampeonato->setDescricao($descricao);
            $objCampeonato->setValorPartida($valor_partida);
            $objCampeonato->setPorcentagemCampeonato($porcentagem_campeonato);
            $objCampeonato->setDataInicio($data_inicio);
            $objCampeonato->setDataFim($data_fim);

            $this->objManager->persist($objCampeonato);
            $this->objManager->flush();

            //@TODO: Realizar inserção do usuário criador como adminsitrador do Campeoanto.
            $id_campeonato = $objCampeonato->getIdCampeonato();


            $this->flashMessenger()->addSuccessMessage("Campeonato Salvo com sucesso!");

            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato']);
        }
        return new ViewModel(['formCampeonato' => $formCampeonato]);
    }

    public function removeAction()
    {
        $id = $this->params()->fromRoute("id", 0);
        if ($this->request->isPost()) {
            $id = $this->request->getPost("id_campeonato");
            $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id);
            $strTituloCampeonato = $objCampeonato->getTitulo();
            $this->objManager->remove($objCampeonato);
            $this->objManager->flush();

            $this->flashMessenger()->addWarningMessage("O Campeonato {$strTituloCampeonato} foi removido!");
            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato']);
        }
        $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id);
        return new ViewModel(['objCampeonato' => $objCampeonato]);
    }

    public function editAction()
    {
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
        return new ViewModel([
            'objCampeonato' => $objCampeonato,
            'formCampeonato' => $formCampeonato
        ]);
    }

    public function scoresAction()
    {
        $id_campeonato = $this->params()->fromRoute("id", 0);
        $id_campeonato_pontuacao = $this->params()->fromRoute("id_aux", 0);

        $formCampeonatoPontuacao = new \Application\Form\CampeonatoPontuacaoForm();

        $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id_campeonato);

        if ($this->request->isPost()) {
            $id_campeonato_pontuacao = $this->request->getPost("id_campeonato_pontuacao");
            $posicao = $this->request->getPost("posicao");
            $valor_pontuacao = $this->request->getPost("valor_pontuacao");

            if ($id_campeonato_pontuacao != '') {
                $objCampeonatoPontuacao = $this->objManager->find('Application\Entity\CampeonatoPontuacao', $id_campeonato_pontuacao);
                $this->flashMessenger()->addSuccessMessage("Alterações na pontuação do Campeonato foram salvas com sucesso!");
            } else {
                $objCampeonatoPontuacao = new CampeonatoPontuacao();
                $this->flashMessenger()->addSuccessMessage("Pontuação do Campeonato  foi salva com sucesso!");
            }

            $objCampeonatoPontuacao->setPosicao($posicao);
            $objCampeonatoPontuacao->setCampeonato($objCampeonato);
            $objCampeonatoPontuacao->setValorPontuacao($valor_pontuacao);
            $this->objManager->persist($objCampeonatoPontuacao);
            $this->objManager->flush();

            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato', 'action' => 'scores', 'id' => $objCampeonato->getIdCampeonato()]);
        }
        $objPontuacoes = $this->objManager->getRepository('Application\Entity\CampeonatoPontuacao')
            ->findBy(['campeonato' => $objCampeonato], ['posicao' => 'ASC']);
        $objPosicaoMax = $this->objManager->getRepository('Application\Entity\CampeonatoPontuacao')
            ->getMaxPosicao($id_campeonato);
        $posicaoMax = $objPosicaoMax[0]['posicao'];

        if ($id_campeonato_pontuacao > 0) {
            $objCampeonatoPontuacao = $this->objManager->find("Application\Entity\CampeonatoPontuacao", $id_campeonato_pontuacao);
            $formCampeonatoPontuacao->bind($objCampeonatoPontuacao);
            $formPosicao = $formCampeonatoPontuacao->get('btn_submit')->setValue('Alterar Pontuação');
        } else {
            $formPosicao = $formCampeonatoPontuacao->get('posicao')->setValue($posicaoMax);
            $formCampeonatoPontuacao->get('btn_new')->setAttribute('class', 'hide');
        }
        return new ViewModel([
            'posicaoMax' => $posicaoMax,
            'objPontuacoes' => $objPontuacoes,
            'objCampeonato' => $objCampeonato,
            'formCampeonatoPontuacao' => $formCampeonatoPontuacao,
        ]);
    }

    public function removeScoreAction()
    {
        $id_campeonato_pontuacao = $this->params()->fromRoute("id_aux", 0);
        if ($this->request->isPost()) {
            $id_campeonato_pontuacao = $this->request->getPost("id_campeonato_pontuacao");
            $objCampeonatoPontuacao = $this->objManager->find('Application\Entity\CampeonatoPontuacao', $id_campeonato_pontuacao);
            $strTituloCampeonatoPontuacao = $objCampeonatoPontuacao->getCampeonato()->getTitulo() . " - Posição " . $objCampeonatoPontuacao->getPosicao();
            $this->objManager->remove($objCampeonatoPontuacao);
            $this->objManager->flush();

            $this->flashMessenger()->addWarningMessage("O Campeonato {$strTituloCampeonatoPontuacao} foi removida!");
            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato', 'action' => 'scores', 'id' => $objCampeonatoPontuacao->getCampeonato()->getIdCampeonato()]);
        }
        $objCampeonatoPontuacao = $this->objManager->find('Application\Entity\CampeonatoPontuacao', $id_campeonato_pontuacao);
        return new ViewModel(['objCampeonatoPontuacao' => $objCampeonatoPontuacao]);
    }

    public function membersAction()
    {
        $id_campeonato = $this->params()->fromRoute("id", 0);
        $id_usuario = $this->params()->fromRoute("id_aux", 0);

        $formUsuario = new \Application\Form\UsuarioForm();
        $formCampeonatoUsuario = new \Application\Form\CampeonatoUsuarioForm();

        $objCampeonato = $this->objManager->find("Application\Entity\Campeonato", $id_campeonato);

        if ($this->request->isPost()) {
            $id_campeonato_pontuacao = $this->request->getPost("id_campeonato_pontuacao");
            $posicao = $this->request->getPost("posicao");
            $valor_pontuacao = $this->request->getPost("valor_pontuacao");

            if ($id_campeonato_pontuacao != '') {
                $objCampeonatoPontuacao = $this->objManager->find('Application\Entity\CampeonatoPontuacao', $id_campeonato_pontuacao);
                $this->flashMessenger()->addSuccessMessage("Alterações na pontuação do Campeonato foram salvas com sucesso!");
            } else {
                $objCampeonatoPontuacao = new CampeonatoPontuacao();
                $this->flashMessenger()->addSuccessMessage("Pontuação do Campeonato  foi salva com sucesso!");
            }

            $objCampeonatoPontuacao->setPosicao($posicao);
            $objCampeonatoPontuacao->setCampeonato($objCampeonato);
            $objCampeonatoPontuacao->setValorPontuacao($valor_pontuacao);
            $this->objManager->persist($objCampeonatoPontuacao);
            $this->objManager->flush();

            return $this->redirect()->toRoute('padrao', ['controller' => 'campeonato', 'action' => 'scores', 'id' => $objCampeonato->getIdCampeonato()]);
        }

        $objCampeonatoUsuarios = $this->objManager->getRepository('Application\Entity\CampeonatoUsuario')
            ->findBy(['campeonato' => $objCampeonato], ['usuario' => 'ASC']);

        return new ViewModel([
            'objCampeonato' => $objCampeonato,
            'objCampeonatoUsuarios' => $objCampeonatoUsuarios,
            'formCampeonatoUsuario' => $formCampeonatoUsuario,
            'formUsuario' => $formUsuario,
        ]);
    }

}
