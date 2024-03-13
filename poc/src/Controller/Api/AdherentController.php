<?php

namespace App\Controller\Api;

use App\Entity\Adherent;
use App\Repository\AdherentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AdherentController extends AbstractController
{
    #[Route('/api/adherents', name: 'app_api_adherent')]
    public function index(AdherentRepository $adherentRepository): JsonResponse
    {
        $adherents = $adherentRepository->findAll();
        return $this->json($adherents, 200, [], ['groups' => 'adherent:read']);
    }

    #[Route('/api/adherent/{email}', name: 'app_api_adherent_single', requirements: ['email' => '.+'])]
    public function adherent_single(string $email, AdherentRepository $adherentRepository): JsonResponse
    {
        $adherent = $adherentRepository->findOneBy(['email' => $email]);

        if (empty($adherent)) {
            return $this->json(['message' => 'Aucun adhérent trouvé : ' . $email], 404);
        }
        // return $this->json($adherents);
        return $this->json($adherent, 200, [], ['groups' => 'adherent:read']);
    }


    #[Route('/api/adherents/modifier/{nom}', name: 'app_api_adherent_edit')]
    public function adherent_edit(string $nom, ObjectManager $manager, Request $request, AdherentRepository $adherentRepository): JsonResponse
    {
        $adherent = $adherentRepository->findOneBy(['nom' => $nom]);

        if (empty($adherent)) {
            return $this->json(['message' => 'Le problème : ' . $nom], 404);
        }

        // Récupération des données du formulaire
        $requestData = json_decode($request->getContent(), true);

        // Mise à jour des informations de l'adhérent
        $adherent->setNom($requestData['nom'] ?? $adherent->getNom());

        // Enregistrer les modifications dans la base de données
        $manager->persist($adherent);
        // $entityManager = $this->getDoctrine()->getManager();
        $manager->flush();

        // return $this->json($adherents);
        return $this->json($adherent, 200, [], ['groups' => 'adherent:read']);
    }
}
