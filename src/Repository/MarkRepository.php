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
class MarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mark::class);
    }

    // /**
    //  * @return Mark[] Returns an array of Mark objects
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
    public function findOneBySomeField($value): ?Mark
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findMarksByStudent($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 
        '
        SELECT mark.exam_one, mark.exam_two , matiere.name AS matiere 
        FROM mark
        LEFT JOIN student ON mark.student_id = student.id
        LEFT JOIN matiere ON mark.matiere_id = matiere.id
        WHERE mark.student_id = :id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function marksWithStudentInfo()
    {
        return $this->createQueryBuilder('m')
        ->select('m.examOne as examone , m.id , m.examTwo as examtwo , s.firstName as firstname , s.lastName as lastname , d.name as matiere')
        ->join('m.student','s')
        ->join('m.matiere','d')
        ->getQuery()
        ->getResult()
    ;
    }
}
