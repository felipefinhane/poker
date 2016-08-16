<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class PaginationHelper extends AbstractHelper {

    private $controller;
    private $totalItens;
    private $qtdePorPagina;

    public function __invoke($itens, $qtdePorPagina, $controller) {
        $this->controller = $controller;
        $this->totalItens = $itens->count();
        $this->qtdePorPagina = $qtdePorPagina;
        return $this->gerarPaginacao();
    }

    private function gerarPaginacao() {
        $totalPaginas = ceil($this->totalItens / $this->qtdePorPagina);
        $html = '';
        if ($totalPaginas > 1) {
            $html .= "<ul class=\"nav nav-pills\">";
            $cont = 1;
            while ($cont <= $totalPaginas) {
                $html .= "<li>";
                $html .= "<a href=\"{$this->view->url('listagem', ['controller' => $this->controller, 'page' => $cont])}\">{$cont}</a>";
                $html .= "</li>";
                $cont++;
            }
            $html .= "</ul>";
        }
        return $html;
    }

}
