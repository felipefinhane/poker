<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

  public function indexAction() {
    if (!$user = $this->identity()) {
      $this->flashMessenger()->addErrorMessage("ACESSO NÃO PERMITIDO!");
      return $this->redirect()->toUrl('/login');
    }
    $request = $this->getRequest();
    $result = array();
    if ($request->isPost()) {
      $nome = $request->getPost("nome");
      $cpf = $request->getPost("cpf");
      $salario = $request->getPost("salario");

      $funcionario = new \Application\Model\Funcionario();
      $funcionario->setNome($nome);
      $funcionario->setCpf($cpf);
      $funcionario->setSalario($salario);

      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $em->persist($funcionario);
      $em->flush();

      $result["resp"] = $nome . ", enviado corretamente!";
    }
    return new ViewModel($result);
  }

}
