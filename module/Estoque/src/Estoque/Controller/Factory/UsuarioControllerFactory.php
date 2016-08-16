<?php

namespace Estoque\Controller\Factory;

use Zend\ServiceManager\AbstractPluginManager;

use Estoque\Controller\UsuarioController;

class UsuarioControllerFactory {

    /**
     * @param AbstractPluginManager $pluginManager
     *
     * @return IndexController
     */
    public function __invoke(AbstractPluginManager $pluginManager) {
        $container = $pluginManager->getServiceLocator();
        
        $authService = $container->get('Zend\Authentication\AuthenticationService');
        
        return new UsuarioController($authService);
    }

}