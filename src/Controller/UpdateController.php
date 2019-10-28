<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractController
{
    /**
     * @Route("/update", name="update")
     */
    public function index()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Article::class);
        $data = $repository->findAll();

        return $this->render('update/index.html.twig', [
            'data' => $data,
        ]);
    }

    /**
     * @Route("/update/{id}", name="update{id}")
     */
    public function home(Request $request,Article $article) {
        $form = $this->createForm(ArticleType::class, $article);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            return $this->redirect('/home');
        } else {
            return $this->render('update/update.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }
}
