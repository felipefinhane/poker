<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CampeonatoUsuarioRepository extends EntityRepository{

  public function getCampeonatoUsuarios($id_campeonato, $bolAtivo = false){
    $em =  $this->getEntityManager();
    $queryBuilder = $em->createQueryBuilder();

    $queryBuilder->select('cu')
      ->from('Application\Entity\CampeonatoUsuario', 'cu')
      ->innerJoin('cu.usuario', 'u')
      ->innerJoin('cu.campeonato', 'c')
      ->where('c.id_campeonato = :idCampeonato')
      ->setParameter('idCampeonato', $id_campeonato)
      ->orderBy('u.nome');
    if($bolAtivo){
      $queryBuilder->andWhere('cu.status = :bolStatus')->setParameter('bolStatus', 1);
    }
    $queryResult = $queryBuilder->getQuery()->getResult();
    return $queryResult;
  }


}

