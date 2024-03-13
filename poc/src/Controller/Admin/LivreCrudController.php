<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('dateSortie'),
            TextField::new('titre'),
            TextField::new('langue'),
            ImageField::new('photoCouverture')
                ->setLabel('Photo de profil')
                ->setBasePath('/img/livre')
                ->setUploadDir('public/img/livre')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            AssociationField::new('auteur'),
            AssociationField::new('categories')
            ->setLabel('Categories')
            ->setFormTypeOptions([
                'class' => Categorie::class,
                'choice_label' => function ($categories) {
                    return @$categories->getId . $categories->getNom();
                },
            ])   
          ];
    }

}
