<?php

namespace Application\Factory;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\AbstractPluginManager;

use Application\Controller\CampeonatoController;

class CampeonatoControllerFactory {

    /**
     * @param AbstractPluginManager $pluginManager
     *
     * @return CampeonatoController
     */
    public function __invoke(AbstractPluginManager $pluginManager) {
        $container = $pluginManager->getServiceLocator();
        $entityManager = $container->get(EntityManager::class);
//        $repositorio = $entityManager->getRepository(Produto::class);
        return new CampeonatoController($entityManager);
    }

}
