<?php

namespace App\Repository;

use App\Entity\DetailsCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailsCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsCommande[]    findAll()
 * @method DetailsCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailsCommande::class);
    }

    // /**
    //  * @return DetailsCommande[] Returns an array of DetailsCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailsCommande
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getDetailsCommandeProduit($idCommande)
    {
        return $this->createQueryBuilder('d')
            ->select('p.photo', 'p.titre', 'd.quantite', 'p.prix', 'c.montantTotal')
            ->innerJoin('App\Entity\Produit', 'p')
            ->where('d.idProduit = p.id')
            ->innerJoin('App\Entity\Commande', 'c')
            ->andWhere('d.idCommande = c.id')
            ->andWhere('d.idCommande = :idCommande')
            ->setParameter('idCommande', $idCommande)
            ->getQuery()
            ->execute();
    }
}
