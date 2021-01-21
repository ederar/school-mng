<?php

namespace App\Controller;


use App\Entity\Mark;
use App\Entity\Student;
use App\Form\MarkType;
use App\Form\StudentType;
use App\Repository\ClassRoomRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @Route("/teacher/login", name="teacher_log")
     */
    public function login(): Response
    {
        return $this->render('teacher/teacher_login.html.twig');
    }

    /**
     * @Route("/teacher/home", name="teacher_home")
     */
    public function home(TeacherRepository $repo, StudentRepository $srepo)
    {
       
        $teacher = $repo->findOneBy([
            'id' => $this->getUser()->getId()
        ]);
        $teacher_id = $this->getUser()->getId(); 
        $students = $srepo->FindStudentByTeacher($teacher_id);
        return $this->render('teacher/teacher_home.html.twig',[
            'teacher' => $teacher,
            'students' => $students
        ]);
    }

    /**
     * @Route("/teacher/classes", name="teacher_classes")
     */

     public function classes(ClassRoomRepository $repo)
     {
         $teacher_id = $this->getUser()->getId(); 
         $classes = $repo->findClassRoomByTeacher($teacher_id);
        return $this->render('teacher/teacher_classes.html.twig',[
            'classes' => $this->getUser()->getclassRoom()
        ]);
     }

     /**
     * @Route("/teacher/students", name="teacher_students")
     */

    public function students(StudentRepository $repo)
    {
        $teacher_id = $this->getUser()->getId(); 
        $students = $repo->FindStudentByTeacher($teacher_id);
       
       return $this->render('teacher/teacher_students.html.twig',[
           'students' => $students
       ]);
    }

    /**
     * @Route("/teacher/logout", name="teacher_logout")
     */
    public function logout()
    {

    }

        /**
     * @Route("/teacher/classes/{id}", name="teacher_classes_students")
     */

    public function classesDetail($id , StudentRepository $repo , ClassRoomRepository $rep)
    {
        
        $students = $repo->findBy([
            'classroom' => $id
        ]);
        $class = $rep->findOneBy([
            'id' => $id
        ]);
   
       return $this->render('teacher/teacher_classes_students.html.twig',[
            'students' => $students,
            'class'    => $class
       ]);
    }

    /**
     * @Route("/teacher/student/mark/{id}" , name="teacher_add_marks")
     */
    public function marks(Student $student, Request $request)
    {
       
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            foreach($student->getMarks() as $mark){
                $mark->setStudent($student);
                $manager->persist($mark);
            }
            
            $manager->flush();
        }
        return $this->render('teacher/teacher_student_mark.html.twig',[
            'form' => $form->createView(),
            'student' => $student
        ]);
    }
}
