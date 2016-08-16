<?php

namespace Estoque\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\View\Model\ViewModel;
use Estoque\Entity\Produto;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp AS SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message AS MimeMessage;
use Zend\Mime\Part AS MimePart;

class IndexController extends AbstractActionController {

    private $objectManager;

    public function __construct(ObjectManager $objectManager) {
        $this->objectManager = $objectManager;
    }

    public function indexAction() {
        $pagina = $this->params()->fromRoute('page', 1);
        $qtdePorPagina = 5;
        $offset = ($pagina - 1) * $qtdePorPagina;

        $repository = $this->objectManager->getRepository('Estoque\Entity\Produto');
        $produtos = $repository->getProdutosPaginados($qtdePorPagina, $offset);

        $view_params = array(
            'qtdePorPagina' => $qtdePorPagina,
            'produtos' => $produtos
        );

        return new ViewModel($view_params);
    }

    public function cadastrarAction() {
        if(!$user = $this->identity()){
            $this->flashMessenger()->addWarningMessage("Você não tem permissão para acessar.");
            return $this->redirect()->toRoute('estoque',['controller'=>'usuario']);
        }
        $form = new \Estoque\Form\ProdutoForm($this->objectManager);
        
        if ($this->request->isPost()) {
            
            $nome = $this->request->getPost('nome');
            $preco = $this->request->getPost('preco');
            $descricao = $this->request->getPost('descricao');
            $idCategoria = $this->request->getPost('categoria');

            $produto = new Produto();
            $form->setInputFilter($produto->getInputFilter());
            $form->setData($this->request->getPost());
            
            if($form->isValid()){
                $CategoriaRepository = $this->objectManager->getRepository('Estoque\Entity\Categoria');
                $categoria = $CategoriaRepository->find($idCategoria);
                
                $produto->setNome($nome);
                $produto->setPreco($preco);
                $produto->setDescricao($descricao);
                $produto->setCategoria($categoria);

                $this->objectManager->persist($produto);
                $this->objectManager->flush();

                $this->flashMessenger()->addSuccessMessage("Produto cadastrado com sucesso!");

                return $this->redirect()->toUrl("/estoque");
            }
        }
        return new ViewModel(['form'=>$form]);
    }

    public function removerAction() {
        $id = $this->request->getPost('id');
        if (is_null($id)) {
            $id = $this->params()->fromRoute('id');
        }
        $repository = $this->objectManager->getRepository('Estoque\Entity\Produto');
        $produto = $repository->find($id);

        if ($this->request->isPost()) {
            $this->objectManager->remove($produto);
            $this->objectManager->flush();
            $this->flashMessenger()->addSuccessMessage("Produto removido com sucesso!");
            return $this->redirect()->toUrl("/estoque");
        }
        return new ViewModel(array('produto' => $produto));
    }

    public function editarAction() {
        $id = $this->params()->fromRoute('id');
        
        $repository = $this->objectManager->getRepository('Estoque\Entity\Produto');
        $produto = $repository->find($id);

        if ($this->request->isPost()) {
            $nome = $this->request->getPost('nome');
            $preco = $this->request->getPost('preco');
            $descricao = $this->request->getPost('descricao');

            $produto->setNome($nome);
            $produto->setPreco($preco);
            $produto->setDescricao($descricao);

            $this->objectManager->persist($produto);
            $this->objectManager->flush();

            $this->flashMessenger()->addSuccessMessage("Produto alterado com sucesso!");

            return $this->redirect()->toUrl("/estoque");
        }
        return new ViewModel(array('produto' => $produto));
    }

    public function contatoAction() {
        if ($this->request->isPost()) {
            $nome = $this->request->getPost('nome');
            $email = $this->request->getPost('email');
            $mensagem = $this->request->getPost('mensagem');

            $msgHtml = "<b>Nome:</b> {$nome},</br>";
            $msgHtml .= "<b>Email:</b> {$email},</br>";
            $msgHtml .= "<b>Mensagem:</b> {$mensagem},</br>";

            $htmlPart = new MimePart($msgHtml);
            $htmlPart->type = 'text/html';

            $htmlMsg = new MimeMessage();
            $htmlMsg->addPart($htmlPart);

            $email = new Message();
            $email->addTo('felipe@finhane.com');
            $email->setSubject('Contato feito pelo site');
            $email->addFrom('felipe@finhane.com');

            $email->setBody($htmlMsg);

            $config = array(
                'host' => 'smtp.gmail.com',
                'connection_class' => 'login',
                'connection_config' => array(
                    'ssl' => 'tls',
                    'username' => 'felipe@finhane.com',
                    'password' => 'Fuck4all',
                ),
                'port' => 587
            );

            $transport = new SmtpTransport();
            $options = new SmtpOptions($config);
            $transport->setOptions($options);

            $transport->send($email);

            $this->flashMessenger()->addMessage('Email enviado com sucesso');

            return $this->redirect()->toUrl("/estoque");
        }
        return new ViewModel();
    }

}
