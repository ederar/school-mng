<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\AddTeacherType;
use App\Form\EditTeacherType;
use App\Repository\ClassRoomRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function index(): Response
    {
        return $this->render('admin/admin_login.html.twig');
    }


    /**
     * @Route("/admin/home", name="admin_home")
     */

     public function home(ClassRoomRepository $classRepo, TeacherRepository $teacherRepo , StudentRepository $studentRepo)
     {
        
         $classes = $classRepo->findAll();
         $teachers = $teacherRepo->findAll();
         $students = $studentRepo->findAll();
        
        return $this->render('admin/admin_home.html.twig',[
            'classes' => $classes,
            'students' => $students,
            'teachers' => $teachers
        ]);
     }

    /**
     * @Route("/admin/teachers/{page}", name="admin_teachers", requirements={"page":"\d+"})
     */

     public function teachers(TeacherRepository $repo , $page = 1)
     {

         $limit = 5;
         $offset = $page * $limit - $limit;
        $total = count($repo->findAll());
        $pages = ceil($total / $limit);
    
         return $this->render('admin/admin_teachers.html.twig',[
             'teachers' => $repo->test($limit,$offset),
             'page' => $page,
             'pages' => $pages
         ]);
     }

    /**
     * @Route("/admin/teachers/add" , name="admin_add_teacher")
     */

     public function addTeacher(Request $request, UserPasswordEncoderInterface $encoder)
     {
         $teacher = new Teacher;

         $form = $this->createForm(AddTeacherType::class,$teacher);

         $form->handleRequest($request);
         
         if($form->isSubmitted() && $form->isValid())
         {
            $manager = $this->getDoctrine()->getManager();
            foreach($teacher->getClassRoom() as $clas) {
                $clas->addTeacher($teacher);
            }
            $hash = $encoder->encodePassword($teacher, $teacher->getPassword());
            $teacher->setPassword($hash);
            $manager->persist($teacher);
            $manager->flush();
            $this->addFlash('success','Teacher Added');
         }
        return $this->render('admin/admin_add_teacher.html.twig',[
            'form' => $form->createView()
        ]);
     }

     /**
     * @Route("/admin/teacher/edit/{id}" , name="admin_edit_teacher")
     */

     public function editTeacher($id , TeacherRepository $repo, Request $request)
     {

        $teacher = $repo->findOneBy(['id' => $id]);
        $form = $this->createForm(EditTeacherType::class, $teacher);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();

            $this->addFlash('success','Teacher Modified');
        }
        return $this->render('admin/admin_edit_teacher.html.twig' ,[
            'teacher' => $teacher,
            'form' => $form->createView()
        ]);
     }
}
