<?php

namespace App\Controller\Admin;

use App\Entity\Emprunt;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Repository\LivreRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservations;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Doctrine\ORM\EntityManagerInterface;

class EmpruntCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public static function getEntityFqcn(): string
    {
        return Emprunt::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $fields = [
            AssociationField::new('adherent'),
            DateField::new('dateEmprunt'),
            DateField::new('dateRetour'),

        ];
    
        if ($pageName === Crud::PAGE_NEW) {
            $fields[] = AssociationField::new('livre')
            ->setFormTypeOption('query_builder', function (LivreRepository $entityRepository) {
                return $entityRepository->createQueryBuilder('e')
                    ->andWhere('NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Reservations r
                        WHERE r.livre = e.id
                    )')
                    ->andWhere('NOT EXISTS(
                        SELECT 1
                        FROM App\Entity\Emprunt em
                        WHERE em.livre = e.id
                    )')
                    ->orderBy('e.titre', 'ASC');
            });

        } else {
            $fields[] = AssociationField::new('livre');
            $fields[] = TextField::new('retard')->setDisabled(true);
            $fields[] = TextField::new('rendu')->setDisabled(true);
            
        }
        if ($pageName === Crud::PAGE_EDIT) {
            $fields[] = AssociationField::new('livre')->setDisabled(true);
        }

        return $fields;
    }

    public function configureActions(Actions $actions): Actions
    {
        $rendreLivreAction = Action::new('rendreLivre', 'Rendre Livre')
            ->linkToRoute('admin_reservation_rendre_livre', function (Emprunt $emprunt) {
                return ['id' => $emprunt->getId()];
            })
            ->setIcon('fa fa-exchange'); 

        return $actions
            ->add(Crud::PAGE_INDEX, $rendreLivreAction);
    }
    #[Route('/admin/reservation/{id}/rendre-livre', name: 'admin_reservation_rendre_livre')]
    public function rendreLivre(Emprunt $emprunt): Response
    {
        $emprunt->setRendu("Oui");
        // Logique pour rendre le livre ici

        $this->entityManager->persist($emprunt);
        $this->entityManager->flush();
        
        return $this->redirectToRoute('admin',[
            'crudControllerFqcn'=>EmpruntCrudController::class,
            'crudAction'=>'index',
        ]);
    }
    
}
