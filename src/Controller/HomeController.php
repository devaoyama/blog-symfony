<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Article::class);
        $data = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'title' => 'ブログ',
            'data' => $data,
        ]);
    }

    /**
     * @Route("/find/{id}", name="find")
     */
    public function home(Article $article) {
        return $this->render('home/find.html.twig', [
            'data' => $article,
        ]);
    }
}
