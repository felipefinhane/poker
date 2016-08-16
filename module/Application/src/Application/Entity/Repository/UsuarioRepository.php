<?php

namespace Application\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UsuarioRepository extends EntityRepository {

    public function getUsuarioPaginados($qtdePorPagina, $offset) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();

        $queryBuilder->select('u')
                ->from('Application\Entity\Usuario', 'u')
                ->setMaxResults($qtdePorPagina)
                ->setFirstResult($offset)
                ->orderBy('u.id_usuario');

        $query = $queryBuilder->getQuery();

        $paginator = new Paginator($query);
        return $paginator;
    }

}
