<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class MainController extends AbstractController
{
    #[Required]
    public VoitureRepository $voitureRepository;

    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        
        $voitures = $this->voitureRepository->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'voitures' => $voitures,
        ]);
    }
}
