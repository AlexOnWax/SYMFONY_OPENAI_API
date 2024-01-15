<?php

namespace App\Controller;

use App\Entity\Results;
use App\Form\ProCreateType;
use App\Repository\ResultsRepository;
use App\Service\GptApi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AppController extends AbstractController
{
    #[Route('/app', name: 'app_app')]
    public function index(Request $request, EntityManagerInterface $em, ResultsRepository $resultsRepository, GptApi $gptApi): Response
    {   
        $messages = $resultsRepository->findAll();
        $content = new Results();
        $form = $this->createForm(ProCreateType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data= $form->getData();
            $message = $gptApi->getMessage($data);
            $content->setContent($message);
            $em->persist($content);
            $em->flush();
            return $this->redirectToRoute('app_app');
        }

        return $this->render('app/index.html.twig', [
            'form' => $form,
            'messages'=> $messages,
        ]);
    }
}
