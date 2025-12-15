<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class MainController extends AbstractController
{
    #[Required]
    public VoitureRepository $voitureRepository;

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        
        $voitures = $this->voitureRepository->findAll();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'voitures' => $voitures,
            'big_header' => true,
        ]);
    }

    #[Route('/add', name: 'app_add')]
    public function add(): Response
    {
        return $this->render('main/add.html.twig', [
            'controller_name' => 'MainController',
            'big_header' => false,
        ]);
    }

    #[Route('/car/{car}', name: 'app_car', requirements: ['car' => '\d+'], methods: ['GET'])]
    public function car(?Voiture $car): Response
    {
        if (!$car) {
            return $this->render('error.html.twig', [
                'errorMsg' => 'La voiture demandée n\'existe pas.',
            ]);
        }
        return $this->render('main/car.html.twig', [
            'controller_name' => 'MainController',
            'car' => $car,
            'big_header' => false,
        ]);
    }
}