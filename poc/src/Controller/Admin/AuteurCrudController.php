<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class AuteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            DateField::new('dateNaissance')->setFormTypeOption('widget', 'single_text'),
            DateField::new('dateDeces')->setFormTypeOption('widget', 'single_text'),
            TextField::new('nationalite'),
            ImageField::new('photo')
            ->setLabel('Photo de profil')
            ->setBasePath('/img/livre')
            ->setUploadDir('public/img/livre')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            TextareaField::new('description'),
            AssociationField::new('livres'),
        ];
    }
    
}
