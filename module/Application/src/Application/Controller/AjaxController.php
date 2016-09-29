<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\Common\Persistence\ObjectManager;

class AjaxController extends AbstractActionController
{

    private $objManager;

    public function __construct(ObjectManager $objManager)
    {
        $this->objManager = $objManager;
    }

    public function addMember(){

    }

}