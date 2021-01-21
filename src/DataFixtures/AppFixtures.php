<?php

namespace App\DataFixtures;

use App\Entity\ClassRoom;
use App\Entity\Matiere;
use App\Entity\Student;
use App\Entity\Teacher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
      
        $faker = Factory::create('FR-fr');
        $students = [];
        $classRooms = [];
        $matieres = [];
        for ($c=0; $c <= 6; $c++) { 
            $classRoom = new ClassRoom;
            $classRoom->setTitle("1L2")
                      ->setSection('5eme');
        $manager->persist($classRoom);
        $classRooms[] = $classRoom;

        }


        for ($i = 0; $i <= 40; $i++) { 
            $student = new Student;
            $classes = $classRooms[mt_rand(0, 6)];
            $hash = $this->encoder->encodePassword($student,"000");
            $student->setFirstName($faker->firstName())
                    ->setLastName($faker->lastName)
                    ->setEmail($faker->email)
                    ->setPassword($hash)
                    ->setClassroom($classes)
                    ;
        $manager->persist($student);            
        $students[] = $student;
        }
        for ($m = 0; $m <= 7 ; $m++) { 
            $matiere = new Matiere;
            $matiere->setName('Francais')
            ;
            $manager->persist($matiere);
            $matieres[] = $matiere;
            }
      
        for ($t=0; $t <= 10 ; $t++) { 
            $teacher = new Teacher;
            $matier = $matieres[mt_rand(1, 5)];
            $classeR = $classRooms[mt_rand(0, 6)];
            $pass = $this->encoder->encodePassword($teacher , "111");
            $teacher->setFirstName($faker->firstName())
                    ->setLastName($faker->lastName)
                    ->setPassword($pass)
                    ->setEmail($faker->email)
                    ->addClassRoom($classeR)
                    ->setMatiere($matier);
            $manager->persist($teacher);
        }

       
     $manager->flush();
    }
}
