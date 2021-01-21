<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    // /**
    //  * @return Student[] Returns an array of Student objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Student
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function FindStudentByTeacher($id)
    {

        /**SELECT class_room.id, class_room.title , class_room.section , student.first_name , student.last_name , teacher_class_room.class_room_id FROM class_room LEFT JOIN student ON class_room.id = student.classroom_id LEFT JOIN teacher_class_room ON class_room.id = teacher_class_room.class_room_id WHERE teacher_class_room.teacher_id = 12 */

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT class_room.id, class_room.title , class_room.section , student.first_name , student.last_name , teacher_class_room.class_room_id 
        FROM class_room 
        LEFT JOIN student ON class_room.id = student.classroom_id 
        LEFT JOIN teacher_class_room ON class_room.id = teacher_class_room.class_room_id
         WHERE teacher_class_room.teacher_id = :id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}
