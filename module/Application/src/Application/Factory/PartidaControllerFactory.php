<?php

namespace Application\Factory;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\AbstractPluginManager;

use Application\Controller\PartidaController;

class PartidaControllerFactory {

    /**
     * @param AbstractPluginManager $pluginManager
     *
     * @return PartidaController
     */
    public function __invoke(AbstractPluginManager $pluginManager) {
        $container = $pluginManager->getServiceLocator();
        $entityManager = $container->get(EntityManager::class);
//        $repositorio = $entityManager->getRepository(Produto::class);
        return new PartidaController($entityManager);
    }

}
