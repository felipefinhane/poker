<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PartidaRepository extends EntityRepository {

    public function getPartidaPaginados($qtdePorPagina, $offset) {
        $em = $this->getEntityManager();
        
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('p')
                ->from('Application\Entity\Partida', 'p')
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('p.id_partida');
        
        $query = $queryBuilder->getQuery();
        
        $paginator = new Paginator($query);
        return $paginator;
    }

}
