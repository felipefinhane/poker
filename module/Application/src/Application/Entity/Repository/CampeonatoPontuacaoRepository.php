<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CampeonatoPontuacaoRepository extends EntityRepository {

    public function getMaxPosicao($idCampeonato) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();

        $queryBuilder->select('MAX(cp.posicao) + 1 AS posicao')
                ->from('Application\Entity\CampeonatoPontuacao', 'cp')
                ->where('cp.campeonato = :idCampeonato')
                ->setParameter('idCampeonato', $idCampeonato);

        $queryResult = $queryBuilder->getQuery()->getResult();
        return $queryResult;
    }

}
