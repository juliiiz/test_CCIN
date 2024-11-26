<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    // fonction pour récupérer les pokemon
    public function findByEnergieType(string $type)
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.energie', 'b')
            ->where('b.type = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }

    public function findByTournoiNom(string $nom)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.tournoi', 'd')
            ->where('d.nom = :type')
            ->setParameter('nom', $nom)
            ->getQuery()
            ->getResult();
    }

    public function findByTournoiId(int $tournoiId): array
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.tournois', 't') // 'tournois' est le nom de la propriété dans l'entité Pokemon
            ->where('t.id = :tournoiId')
            ->setParameter('tournoiId', $tournoiId)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Pokemon[] Returns an array of Pokemon objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Pokemon
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
