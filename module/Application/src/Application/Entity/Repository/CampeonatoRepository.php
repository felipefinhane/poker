<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CampeonatoRepository extends EntityRepository{
    
    public function getCampeonatoPaginados($qtdePorPagina, $offset){
        $em =  $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        
        $queryBuilder->select('c')
                ->from('Application\Entity\Campeonato', 'c')
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('c.id_campeonato');
                
                $query = $queryBuilder->getQuery();
                
                $paginator = new Paginator($query);
                return $paginator;
    }
    
    
}

