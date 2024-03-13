<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EmpruntControlleController extends AbstractController
{
    #[Route('/api/emprunt/controlle', name: 'app_api_emprunt_controlle')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/EmpruntControlleController.php',
        ]);
    }
}
