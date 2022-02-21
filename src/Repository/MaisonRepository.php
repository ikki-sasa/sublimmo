<?php

namespace App\Repository;

use App\Entity\Maison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Maison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maison[]    findAll()
 * @method Maison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maison::class);
    }

    // /**
    //  * @return Maison[] Returns an array of Maison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Maison
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Maison[] Returns an array of 6 maison objects ordered by latest inserted id
     */
    public function findLastSix()
    {
        //ici on éxecute une requête
        return $this->createQueryBuilder('fls') //fls les lettres de la method fls est un alias obligatoire ici
            // ->andWhere('fls.id > :val') // on cherche un id supérieur a une certaine value
            // ->setParameter('val', 0) //on définit la value
            // ->orderBy('fls.id', 'DESC')
            ->setMaxResults(6) // sélectionne 5 résultats maximum
            ->getQuery() // requête
            ->getResult() // résultat(s)
        ;
    }

    /**
     * @return Maison[] Returns an array of 6 maison objects ordered by latest inserted id 2eme possibilités
     */
    // ont tape la requête classique 
    //  public function trouverDernierSix()
    //  {
    //     $bdd = $this->getEntityManager()->getConnection();
    //     $req = bdd->prepare('SELECT * FROM  maison ORDER BY id DESC LIMIT 6');
    //     $req->executeQuery();
    //     return $req->fetchAllAssociative();
    //  }
}
