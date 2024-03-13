<?php

namespace App\Controller\Api;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/api/categories', name: 'app_api_categorie')]
    public function index(CategorieRepository $categorieRepository): JsonResponse
    {
        $categories = $categorieRepository->findAll();
        // return $this->json($categories);
        return $this->json($categories, 200, [], ['groups' => 'categorie:read']);
    }
}
