<?php

namespace App\Controller\Admin;
use App\Entity\Emprunt;
use App\Entity\Reservations;
use App\Repository\LivreRepository;
use App\Repository\AdherentRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class ReservationsCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Reservations::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            DateField::new('dateResa'),

        ];
    
        if ($pageName === Crud::PAGE_NEW) {
            $fields[] = AssociationField::new('adherent')
            ->setFormTypeOption('query_builder', function (AdherentRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('a')
                    ->select('a')
                    ->leftJoin('a.reservations', 'r')
                    ->groupBy('a.id')
                    ->having('COUNT(r.id) < 3')
                    ->orderBy('a.nom', 'ASC');
            });
            $fields[] = AssociationField::new('livre')
            ->setFormTypeOption('query_builder', function (LivreRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('e')
                    ->andWhere('NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Reservations r
                        WHERE r.livre = e.id
                    )')
                    ->andWhere('(NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Emprunt em1
                        WHERE em1.livre = e.id
                        AND em1.rendu = :rendu
                    ) OR NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Emprunt em2
                        WHERE em2.livre = e.id
                    ))')
                    ->setParameter('rendu', 'Non')
                    ->orderBy('e.titre', 'ASC');
            });

        } else {
            // Si vous n'êtes pas sur la page de création ou de modification, ajoutez simplement un champ de lecture seule pour le livre
            $fields[] = AssociationField::new('adherent');
            $fields[] = AssociationField::new('livre');
            
        }
        if ($pageName === Crud::PAGE_EDIT){
            $fields[] = AssociationField::new('livre')->setDisabled(true);
        }
    
        return $fields;
    }
    public function configureActions(Actions $actions): Actions
    {
        $transformToReservationAction = Action::new('transformToReservation', 'Transformer en Emprunt')
            ->linkToRoute('admin_reservation_transform_to_reservation', function (Reservations $reservation) {
                return ['id' => $reservation->getId()];
            })
            ->setIcon('fa fa-exchange'); 

        return $actions
            ->add(Crud::PAGE_INDEX, $transformToReservationAction);
    }
    #[Route('/admin/reservation/{id}/transform-to-reservation', name: 'admin_reservation_transform_to_reservation')]
    public function transformToReservation(Reservations $reservation, Request $request) : Response
    {
        $emprunt = new Emprunt();


        $dateEmprunt = $reservation->getDateResa();
        $emprunt->setDateEmprunt($dateEmprunt);

        // Ajoutez 7 jours à la date d'emprunt pour obtenir la date de retour
        $dateRetour = strtotime('+7 days', strtotime($dateEmprunt->format('Y-m-d H:i:s')));
        $dateRetour = date('Y-m-d H:i:s', $dateRetour);
    
        $emprunt->setDateRetour(new \DateTime($dateRetour));
        $emprunt->setAdherent($reservation->getAdherent());
        $emprunt->setLivre($reservation->getLivre());
        $emprunt->setRetard("Non");
        $emprunt->setRendu("Non");
        $this->entityManager->persist($emprunt);
        $this->entityManager->flush();
            // Supprimez la réservation
        $this->entityManager->remove($reservation);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('admin',[
            'crudControllerFqcn'=>EmpruntCrudController::class,
            'crudAction'=>'index',
        ]);
    }
    



}
