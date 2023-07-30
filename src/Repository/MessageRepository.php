<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Message>
 *
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function add(Message $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Message $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findMessagesPaginated(int $page, string $slug, int $limit = 2): array
    {
        // obtenir une limite positif
        $limit = abs($limit);

        $result = [];

        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('t', 'm')
            ->from('App\Entity\Message', 'm')
            ->join('m.trick', 't')
            ->where("t.slug = '$slug'")
            ->setMaxResults($limit)
            // premier message de la page ou l'on se trouve
            ->setFirstResult(($page * $limit) - $limit)
            ->orderBy('m.createdAt', 'DESC');

        // on utilise le paginator de doctrine et dedans, on passe la requête
        $paginator = new Paginator($query);
        // on effectue la pagination en récupérant les données
        $data = $paginator->getQuery()->getResult();
        // on vérifie si on a des données
        if (empty($data)) {
            // on renvoie un tableau vide
            return $result;
        }
        // on calcule le nombre de pages par rapport au nbre de messages, ceil arrondi au nbre sup
        $pages = ceil($paginator->count() / $limit);
        // on remplit le tableau
        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;

        return $result;
    }

    /*
    public function paginationMessage($trick)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.trick = :trick')
            ->setParameter('trick', $trick)
            ->getQuery();
    }*/

    //    /**
    //     * @return Message[] Returns an array of Message objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Message
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
