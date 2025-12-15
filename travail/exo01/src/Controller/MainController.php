<?php

namespace App\Controller;

use Exception;
use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MainController extends AbstractController
{
    #[Required]
    public VoitureRepository $voitureRepository;

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        
        $voitures = $this->voitureRepository->findAll();

        return $this->render('main/index.html.twig', [
            'voitures' => $voitures,
            'big_header' => true,
        ]);
    }

    #[Route('/add', name: 'app_add')]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newCar = new Voiture();
        $form = $this->createForm(VoitureType::class, $newCar);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($newCar);
                $entityManager->flush();
            } catch (Exception $e) {
                return $this->render('error.html.twig', [
                    'errorMsg' => "Une erreur est survenue lors de l'ajout de la voiture : {$e->getMessage()}",
                ]);
            }
            return $this->redirectToRoute('app_main');
        }
        return $this->render('main/add.html.twig', [
            'form' => $form,
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
            'car' => $car,
            'big_header' => false,
        ]);
    }
}