<?php

namespace App\Repository;

use App\Entity\Mark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mark|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mark|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mark[]    findAll()
 * @method Mark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class MarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mark::class);
    }

    /**
     * Get mark averages group by subject
     *
     * @param ?int $studentId The student id
     * @return array An arry containing all average makrs subject and value
     */
    public function getAveragesMarksBySubject($studentId = null): array
    {
        $qb = $this->createQueryBuilder('m')
            ->select('m.subject', 'avg(m.value) as average')
            ->groupBy('m.subject')
            ->orderBy('m.subject', 'ASC')
            ;

        if (null !== $studentId) {
            $qb->andWhere('m.student = :id');
            $qb->setParameter('id', $studentId);

        }

        return $qb ->getQuery()->getResult();
    }
}
