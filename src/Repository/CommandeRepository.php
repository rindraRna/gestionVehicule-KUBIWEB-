<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    // /**
    //  * @return Commande[] Returns an array of Commande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function derniereCommandeCree(): ?Commande
    {
        return $this->createQueryBuilder('Commande')
            ->orderBy('Commande.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // public function getCommandeClient(): array
    // {
    //     $entityManager = $this->getEntityManager();
    //     $query = $entityManager->createQuery(
    //         "SELECT c.id numero, c.dateCommande dateCommande, cl.nom nom, cl.prenom prenom, cl.email email, c.montantTotal montantTotal
    //         FROM App\Entity\Commande c
    //         JOIN App\Entity\Client cl
    //         ON c.idClient = cl.id"
    //     );

    //     // returns an array of Product objects
    //     return $query->getResult();
    // }

    public function getCommandeClient()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id', 'c.dateCommande', 'cl.nom', 'cl.prenom', 'cl.email', 'c.montantTotal')
            ->innerJoin('App\Entity\Client', 'cl')
            ->where('c.idClient = cl.id')
            ->getQuery()
            ->execute();
    }
}
