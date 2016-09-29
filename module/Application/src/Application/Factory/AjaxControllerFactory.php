<?php

namespace Application\Factory;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\AbstractPluginManager;

use Application\Controller\AjaxController;

class AjaxControllerFactory {

    /**
     * @param AbstractPluginManager $pluginManager
     *
     * @return AjaxController
     */
    public function __invoke(AbstractPluginManager $pluginManager) {
        $container = $pluginManager->getServiceLocator();
        $entityManager = $container->get(EntityManager::class);
        return new AjaxController($entityManager);
    }

}
