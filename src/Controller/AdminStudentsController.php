<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminStudentsController extends AbstractController
{
    /**
     * @Route("/admin/students/{page}", name="admin_students", requirements={"page" : "\d+"})
     */
    public function students(StudentRepository $repo, $page = 1): Response
    {
        $limit = 10;
        $total = count($repo->findAll());
        $offset = $page * $limit - $limit ;
        $pages = ceil($total / $limit);
        return $this->render('admin_students/index.html.twig', [
            'students' => $repo->findBy([],[],$limit, $offset),
            'page' => $page,
            'pages' => $pages
        ]);
    }
}
