<?php

namespace App\Controller\Api;

use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EmpruntController extends AbstractController
{
    #[Route('/api/emprunts', name: 'app_api_emprunt')]
    public function index(EmpruntRepository $empruntRepository): JsonResponse
    {
        $emprunts = $empruntRepository->findAll();
        // return $this->json($emprunts);
        return $this->json($emprunts, 200, [], ['groups' => 'emprunt:read']);
    }
}
