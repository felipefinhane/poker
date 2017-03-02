<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MenuHelper extends AbstractHelper {

    public function __invoke($controllerActive = 'home') {
        $menuControllers = [
            'home' => $this->view->translate('home'),
            'campeonato' => $this->view->translate('Campeonato'),
            // 'partida' => $this->view->translate('Partidas'),
            'usuario' => $this->view->translate('Participantes')
        ];
        $html = "<div class=\"collapse navbar-collapse\">"; 
        $html .= "    <ul class=\"nav navbar-nav\">"; 
        foreach ($menuControllers as $key => $menu) {
            $strClass = ($key == $controllerActive) ? 'class="active"' : '';
            $html .= "<li {$strClass}><a href=\"{$this->view->url('padrao', ['controller' => $key])}\">{$menu}</a></li>"; 
        }
        $html .= "  </ul>"; 
        $html .= "</div>"; 
        echo $html;
    }

}
