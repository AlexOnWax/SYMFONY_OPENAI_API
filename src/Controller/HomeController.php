<?php

namespace App\Controller;

use App\Repository\ResultsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_home_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ResultsRepository $resultsRepository): Response
    {
        $messages = $resultsRepository->findAll();
        //dd($users);
        return $this->render('home/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}
