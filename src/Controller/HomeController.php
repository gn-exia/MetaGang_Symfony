<?php

namespace App\Controller;

use App\Repository\CardRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Route("/home/{search}", name="home", defaults={"search":""})
     */
    public function index($search = null,  CardRepository $cardRepo): Response
    {
        //$manager = $this->getDoctrine()->getManager();
        //$postRepo = $this->getDoctrine()->getRepository(Post::class);
        if (!empty($search)) {
            $items = $cardRepo->search($search);
        } else {
            $items = $cardRepo->findAll();
        }
        return $this->render('home/index.html.twig', [
            'items' => $items,
        ]);
    }
}
