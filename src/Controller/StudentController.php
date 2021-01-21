<?php

namespace App\Controller;

use App\Repository\MarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student/login", name="student_login")
     */
    public function login(): Response
    {
        return $this->render('student/index.html.twig');
    }

    /**
     * @Route("/student/logout", name="student_logout")
     */

     public function logout()
     {

     }


    /**
     * @Route("/student/home", name="student_home")
     */
     public function studentHome()
     {
        return $this->render('student/student_home.html.twig');
     }

     /**
      * @Route("/student/marks", name="student_marks")
      */
     public function studentMarks(MarkRepository $repo)
     {

        $studentId = $this->getUser()->getId();
        $marks = $repo->findMarksByStudent($studentId);
        
        return $this->render('student/student_marks.html.twig',[
            'notes' => $marks
        ]);
     }
}
