<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findAllWithPagination($page, $limit)
    {
        return $this->createQueryBuilder('b')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


    // Pour éviter les problèmes liés au lazy loading de Doctrine (qui charge les données à la demande),
    // on peut forcer un chargement complet des données directement dans la méthode findAllWithPagination.

    // Cela permet que toutes les infos soient prêtes et que la mise en cache fonctionne correctement, sans toucher au contrôleur.
    // Concrètement, on change un peu la requête pour lui dire : « Ne charge pas les données petit à petit (lazy), mais charge tout d’un coup (eager) ».
    // C’est ce qu’on appelle définir le fetchMode à FETCH_EAGER au lieu de FETCH_LAZY (qui est le mode par défaut).

    // public function findAllWithPagination($page, $limit)
    // {

    //     $qb = $this->createQueryBuilder('b')
    //         ->setFirstResult(($page - 1) * $limit)
    //         ->setMaxResults($limit);

    //     $query = $qb->getQuery();
    //     $query->setFetchMode(Book::class, "author", \Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);
    //     return $query->getResult();
    // }
}
