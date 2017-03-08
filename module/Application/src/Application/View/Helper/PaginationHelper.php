<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class PaginationHelper extends AbstractHelper {

  private $controller;
  private $totalItens;
  private $qtdePorPagina;
  private $customUrl;

  public function __invoke($itens, $qtdePorPagina, $controller, $customUrl = null) {
    $this->controller = $controller;
    $this->totalItens = $itens->count();
    $this->qtdePorPagina = $qtdePorPagina;
    $this->customUrl = $customUrl;
    return $this->gerarPaginacao();
  }

  private function gerarPaginacao() {
    $totalPaginas = ceil($this->totalItens / $this->qtdePorPagina);
    $html = '';
    if ($totalPaginas > 1) {
      $html .= "<ul class=\"nav nav-pills\">";
      $cont = 1;
      while ($cont <= $totalPaginas) {
        $strUrl = $this->view->url('listagem', ['controller' => $this->controller, 'page' => $cont]);
        if(!is_null($this->customUrl)){
          $arrParam = array_merge($this->customUrl['param'], ['page' => $cont]);
          $strUrl = $this->view->url($this->customUrl['name'], $arrParam);
        }
        $html .= "<li>";
        $html .= "<a href=\"{$strUrl}\">{$cont}</a>";
        $html .= "</li>";
        $cont++;
      }
      $html .= "</ul>";
    }
    return $html;
  }

}
