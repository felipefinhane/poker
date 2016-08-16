<?php

namespace Estoque\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProdutoRepository extends EntityRepository{
    
    public function getProdutosPaginados($qtdePorPagina, $offset){
        $em =  $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        
        $queryBuilder->select('p')
                ->from('Estoque\Entity\Produto', 'p')
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('p.id');
                
                $query = $queryBuilder->getQuery();
                
                $paginator = new Paginator($query);
                return $paginator;
    }
    
    
}

