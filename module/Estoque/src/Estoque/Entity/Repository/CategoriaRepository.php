<?php

namespace Estoque\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CategoriaRepository extends EntityRepository{
    
    public function getCategoriaPaginados($qtdePorPagina, $offset){
        $em =  $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        
        $queryBuilder->select('c')
                ->from('Estoque\Entity\Categoria', 'c')
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('c.id');
                
                $query = $queryBuilder->getQuery();
                
                $paginator = new Paginator($query);
                return $paginator;
    }
    
    
}

