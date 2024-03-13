# SAE-S6 - Gestion de Bibliothèque avec Symfony

Bienvenue dans le projet de gestion de bibliothèque développé avec Symfony. Ce projet vise à fournir une application de gestion complète pour une bibliothèque, en utilisant le framework Symfony.

## Prérequis

Avant de pouvoir passer à l'installation, il vous faudra dans un premier temps installer tous ces outils indispensables, pour l'utilisation de cette application.

- PHP 8
- Symfony (cli)
- Composer
- Node.js
  - npm
- Angular (cli)
- VSCode

## Installation

Avant de commencer, assurez-vous d'avoir tout les prérequis d'intaller sur votre machine. Clonez ensuite ce référentiel :

```bash
git clone https://github.com/Christopher973/app-gestion_bibliotheque.git
```

### Lancement de la base de donnée MariaDB en local
```bash
cd mariadb-fp
.\start-server.bat
```

### Installation & lancement du back-office
```bash
cd poc

# installation des dépendances
composer install

# création et initialisation de la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate 

# lancement du back-office sur un serveur local : http://localhost:8000
php -S localhost:8000 -t public

# Pour accéder à l'api : http://localhost:8000/api
```

### Installation & lancement du front
```bash
cd front_biblio

# installation des dépendances
npm install 

# lancement du front sur un serveur local : http://localhost:4200
ng serve
```

## Documentation Utilisateurs

### Back Office

Les CRUD des différentes ressources fonctionnement globalement de la même manière, c'est pour cela que je démontre la fonctionnalité que d'une ressources sur toutes.

#### Consulter les données 

1. Se connecter à un compte admin à l'url : http://localhost:8000/login (login: a@a.a ; password: a)

    ![Tux, the Linux mascot](/assets/login.png)

2. Accéder au back-office à l'url : http://localhost:8000/admin
    
    Vous pouvez consulter les différentes ressources en cliquant sur les différents liens de celles-ci (voir l'exemple ci-dessous)

    ![Tux, the Linux mascot](/assets/read-data.png)

#### Ajouter une données 

1. Accéder au formulaire de création, remplissez les champs et valider

    ![Tux, the Linux mascot](/assets/create1.png)
    
    ![Tux, the Linux mascot](/assets/create2.png)

#### Modifier une données 

1. Accéder au formulaire de modification, modifier les champs et valider

2. Accéder au back-office à l'url : http://localhost:8000/admin

    ![Tux, the Linux mascot](/assets/edit1.png)
    
    ![Tux, the Linux mascot](/assets/edit2.png)

#### Supprimer une données 

2. Cliquer sur le bouton "plus" d'une donnée et supprimer là

    ![Tux, the Linux mascot](/assets/delete1.png)
    
    ![Tux, the Linux mascot](/assets/delete2.png)

    ![Tux, the Linux mascot](/assets/delete3.png)

### Front Office

#### Consulter les livres

1. Accéder front office et consulter les livres à l'url : http://localhost:4200/livres

    ![Tux, the Linux mascot](/assets/read-book.png)

#### Par catégorie

1. Sélectionner une catégorie dans le menu déroulant dans l'en-tête

    ![Tux, the Linux mascot](/assets/book-per-category.png)

    ![Tux, the Linux mascot](/assets/book-per-category2.png)

#### Par recherche

1. Sélectionner un nom de livres dans la barre de recherche

    ![Tux, the Linux mascot](/assets/search.png)

    ![Tux, the Linux mascot](/assets/search2.png)