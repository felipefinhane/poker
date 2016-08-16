<?php

namespace Estoque\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController{
    
    /** @var  AuthService */
    private $authService ;
    
    
    public function __construct(\Zend\Authentication\AuthenticationService $authService) {
        $this->authService = $authService;
    }


    public function indexAction(){
        return new ViewModel();
    }
    
    public function loginAction(){
        if ($this->request->isPost()){
            $dados = $this->request->getPost();
            
            $authAdapter = $this->authService->getAdapter();
            
            $authAdapter->setIdentity($dados['login']);
            $authAdapter->setCredential($dados['senha']);
            
            $authResult = $this->authService->authenticate();
            
            if($authResult->isValid()){
                return $this->redirect()->toRoute('estoque',['controller'=>'index','action'=> 'cadastrar']);
            }else{
                $this->flashMessenger()->addErrorMessage("Usuário ou senha inválidos.");
                return $this->redirect()->toRoute('estoque',['controller'=>'usuario']);
            }
        }else{
            $this->flashMessenger()->addWarningMessage("Você não tem permissão para acessar.");
            return $this->redirect()->toRoute('estoque',['controller'=>'usuario']);
        }
    }
    
    public function logoutAction(){
        $this->authService->clearIdentity();
        return $this->redirect()->toRoute('estoque',['controller'=>'usuario']);
    }
}
