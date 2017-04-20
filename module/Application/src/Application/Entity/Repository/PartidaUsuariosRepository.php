<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PartidaUsuariosRepository extends EntityRepository{

  public function getPartidaUsuarios($idPartida = null, $bolAtivo = false){
    $em =  $this->getEntityManager();
    $queryBuilder = $em->createQueryBuilder();

    $queryBuilder->select('pu')
      ->from('Application\Entity\PartidaUsuarios', 'pu')
      ->innerJoin('pu.participante', 'cu')
      ->innerJoin('pu.partida', 'p')
      ->innerJoin('cu.usuario', 'u')
      ->where('p.id_partida = :idPartida')
      ->setParameter('idPartida', $idPartida)
      ->orderBy('pu.posicao, u.nome');
    if($bolAtivo){
      $queryBuilder->andWhere('pu.status = :bolStatus')->setParameter('bolStatus', 1);
    }
    $queryResult = $queryBuilder->getQuery()->getResult();
    return $queryResult;
  }


}

