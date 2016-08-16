<?php

namespace Application\Factory;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\AbstractPluginManager;

use Application\Controller\UsuarioController;

class UsuarioControllerFactory {

    /**
     * @param AbstractPluginManager $pluginManager
     *
     * @return UsuarioController
     */
    public function __invoke(AbstractPluginManager $pluginManager) {
        $container = $pluginManager->getServiceLocator();
        $entityManager = $container->get(EntityManager::class);
//        $repositorio = $entityManager->getRepository(Produto::class);
        return new UsuarioController($entityManager);
    }

}
