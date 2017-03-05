<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PartidaRepository extends EntityRepository {

    public function getPartidaPaginados($idCampeonato, $qtdePorPagina, $offset) {
        $em = $this->getEntityManager();
        
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('p')
                ->from('Application\Entity\Partida', 'p')
                ->innerJoin('p.campeonato', 'c')
                ->where('c.id_campeonato = :idCampeonato')
                ->setParameter('idCampeonato', $idCampeonato)
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('p.data','DESC');
        
        $query = $queryBuilder->getQuery();
        
        $paginator = new Paginator($query);
        return $paginator;
    }

}
