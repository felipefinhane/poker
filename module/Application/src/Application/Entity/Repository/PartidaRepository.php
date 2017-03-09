<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PartidaRepository extends EntityRepository {

    public function getPartidaPaginados($idCampeonato, $qtdePorPagina, $offset) {
        $em = $this->getEntityManager();
        
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('p')
                // ->addSelect('COUNT(pu.id_partida_usuario) AS totalParticipantes')
                ->from('Application\Entity\Partida', 'p')
                ->innerJoin('p.campeonato', 'c')
                ->innerJoin('p.participantes', 'pu')
                ->where('c.id_campeonato = :idCampeonato')
                ->setParameter('idCampeonato', $idCampeonato)
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('p.data','DESC')
                ->groupBy('p.id_partida');
        
        $query = $queryBuilder->getQuery();
        $paginator = new Paginator($query);
        return $paginator;
    }

}
