<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController {

  private $objManager;

  public function __construct(\Doctrine\Common\Persistence\ObjectManager $objManager) {
    $this->objManager = $objManager;
  }

  public function indexAction() {
    $pagina = $this->params()->fromRoute('page', 1);
    $qtdePorPagina = 6;
    $offset = ($pagina - 1) * $qtdePorPagina;

    $objUsuarios = $this->objManager->getRepository("Application\Entity\Usuario")->getUsuarioPaginados($qtdePorPagina, $offset);

    $view_params = array(
      'qtdePorPagina' => $qtdePorPagina,
      'objUsuarios' => $objUsuarios
    );

    return new ViewModel($view_params);
  }

  public function newAction() {
    $formUsuario = new \Application\Form\UsuarioForm();
    $request = $this->getRequest();
    if ($request->isPost()) {
      $nome = $request->getPost("nome");
      $telefone = $request->getPost("telefone");
      $email = $request->getPost("email");
      $senha = $request->getPost("senha");

      $objUsuario = new \Application\Entity\Usuario();
      $objUsuario->setNome($nome);
      $objUsuario->setTelefone($telefone);
      $objUsuario->setEmail($email);
      $objUsuario->setSenha($senha);

      $this->objManager->persist($objUsuario);
      $this->objManager->flush();

      $this->flashMessenger()->addSuccessMessage("Usuário/Participante Salvo com sucesso!");

      return $this->redirect()->toRoute('padrao', ['controller' => 'usuario']);
    }
    return new ViewModel(['formUsuario' => $formUsuario]);
  }

  public function removeAction() {
    $id = $this->params()->fromRoute("id", 0);
    if ($this->request->isPost()) {
      $id = $this->request->getPost("id_usuario");
      $objUsuario = $this->objManager->find("Application\Entity\Usuario", $id);
      $strNomeUsuario = $objUsuario->getNome();
      $this->objManager->remove($objUsuario);
      $this->objManager->flush();

      $this->flashMessenger()->addWarningMessage("O usuário {$strNomeUsuario} foi removido!");
      return $this->redirect()->toRoute('padrao', ['controller' => 'usuario']);
    }
    $objUsuario = $this->objManager->find("Application\Entity\Usuario", $id);
    return new ViewModel(['objUsuario' => $objUsuario]);
  }

  public function editAction() {
    $id = $this->params()->fromRoute("id", 0);
    $formUsuario = new \Application\Form\UsuarioForm();
    $request = $this->getRequest();
    if ($request->isPost()) {
      $id = $request->getPost("id_usuario");
      $nome = $request->getPost("nome");
      $telefone = $request->getPost("telefone");
      $email = $request->getPost("email");
      $senha = $request->getPost("senha");

      $objUsuario = $this->objManager->find("Application\Entity\Usuario", $id);
      $objUsuario->setNome($nome);
      $objUsuario->setTelefone($telefone);
      if (strlen($senha) > 0) {
        $objUsuario->setEmail($email);
      }
      $objUsuario->setSenha($senha);

      $this->objManager->persist($objUsuario);
      $this->objManager->flush();

      $this->flashMessenger()->addSuccessMessage("Usuário/Participante Salvo com sucesso!");

      return $this->redirect()->toRoute('padrao', ['controller' => 'usuario']);
    }
    $objUsuario = $this->objManager->find("Application\Entity\Usuario", $id);
    $formUsuario->bind($objUsuario);
    return new ViewModel(['formUsuario' => $formUsuario]);
  }

  public function loginAction() {
//    if ($user = $this->identity()) {
//      return $this->redirect()->toUrl('/');
//    }
    if ($this->request->isPost()) {
      $dados = $this->request->getPost();
      echo "<pre>";
      var_dump($dados);
      die();
//
//      $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
//
//      $authAdapter = $authService->getAdapter();
//      $authAdapter->setIdentityValue($dados['username']);
//      $authAdapter->setCredentialValue($dados['password']);
//
//      $authResult = $authService->authenticate();
//
//
//
//      if ($authResult->isValid()) {
//        return $this->redirect()->toUrl('/');
//      } else {
//        $this->flashMessenger()->addErrorMessage("Usuário ou Senha inválidos!");
//        return $this->redirect()->toUrl('/login');
//      }
    }
    $viewModel = new ViewModel();
    $viewModel->setTerminal(true);
    return $viewModel;
  }

  public function logoutAction() {
    echo "<pre>";
    var_dump("LOGOUT HERE");
    die();
  }

}
