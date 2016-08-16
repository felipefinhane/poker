<?php

namespace Estoque\Controller\Factory;

use Doctrine\ORM\EntityManager;
use Estoque\Entity\Produto;
//use Interop\Container\ContainerInterface;
use Zend\ServiceManager\AbstractPluginManager;

use Estoque\Controller\IndexController;

class IndexControllerFactory {

    /**
     * @param AbstractPluginManager $pluginManager
     *
     * @return IndexController
     */
    public function __invoke(AbstractPluginManager $pluginManager) {
        $container = $pluginManager->getServiceLocator();
        
        $entityManager = $container->get(EntityManager::class);
//        $repositorio = $entityManager->getRepository(Produto::class);
        
        return new IndexController($entityManager);
    }

}
