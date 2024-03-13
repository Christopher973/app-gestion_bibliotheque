<?php

namespace App\DataFixtures;

use App\Entity\Adherent;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\Reservations;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BiblioFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        // 1. Création des catégories
        $categoriesData = [
            ['Roman', 'Livres de fiction narratifs'],
            ['Science-Fiction', 'Livres basés sur des concepts scientifiques imaginaires'],
            ['Mystère', 'Livres avec des éléments de mystère et de suspense'],
            ['Biographie', 'Livres qui racontent la vie de personnes réelles'],
            ['Poésie', 'Livres de poèmes et de vers'],
        ];
        $categories = [];
        foreach ($categoriesData as $categoryData) {
            [$nom, $description] = $categoryData;

            $category = (new Categorie())
                ->setNom($nom)
                ->setDescription($description);

            $categories[] = $category;
            $manager->persist($category);
        }
        $manager->flush();

        // 2. Création des auteurs
        $auteurs = [];
        for ($i = 0; $i < 10; $i++) {
            // $dateNaissance = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-70 years', '-30 years'));
            $dateNaissance = $faker->dateTimeBetween('-70 years', '-30 years');
            // $dateDeces = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-30 years', 'now'));
            $dateDeces = $faker->dateTimeBetween('-30 years', 'now');

            $auteur = (new Auteur())
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setDateNaissance(DateTimeImmutable::createFromMutable($dateNaissance))
                ->setDateDeces(DateTimeImmutable::createFromMutable($dateDeces))
                ->setNationalite($faker->country)
                ->setPhoto('https://picsum.photos/360/360?image=' . $i)
                ->setDescription($faker->sentence);

            $auteurs[] = $auteur;
            $manager->persist($auteur);
        }
        $manager->flush();

        // 3. Création des livres
        $livres = [];
        for ($i = 0; $i < 15; $i++) {
            // $dateSortie = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 years', 'now'));
            $dateSortie = $faker->dateTimeBetween('-10 years', 'now');

            $livre = (new Livre())
                ->setTitre($faker->name)
                ->setDateSortie(DateTimeImmutable::createFromMutable($dateSortie))
                ->setLangue($faker->languageCode)
                ->setPhotoCouverture('https://picsum.photos/360/360?image=' . ($i + 200));

            // Ajout des auteurs au livre
            shuffle($auteurs);
            $randomAuteurs = array_slice($auteurs, 0, mt_rand(1, 3));
            foreach ($randomAuteurs as $auteur) {
                $livre->addAuteur($auteur);
            }

            // Ajout des catégories au livre
            shuffle($categories);
            $randomCategories = array_slice($categories, 0, mt_rand(1, 2));
            foreach ($randomCategories as $category) {
                $livre->addCategory($category);
            }

            $livres[] = $livre;
            $manager->persist($livre);
        }
        $manager->flush();

        // 4. Création des adhérents
        $adherents = [];
        for ($i = 0; $i < 20; $i++) {
            // $dateAdhesion = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years', 'now'));
            $dateAdhesion = $faker->dateTimeBetween('-2 years', 'now');

            // $dateNaissance = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-70 years', '-30 years'));
            $dateNaissance = $faker->dateTimeBetween('-70 years', '-30 years');



            $adherent = (new Adherent())
                ->setDateAdhesion(DateTimeImmutable::createFromMutable($dateAdhesion))
                ->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setDateNaiss(DateTimeImmutable::createFromMutable($dateNaissance))
                ->setEmail($faker->email)
                ->setPassword($faker->password)
                ->setAdressePostale($faker->postcode)
                ->setNumTel('09281723')
                ->setPhoto('https://picsum.photos/360/360?image=' . ($i + 300));

            $adherents[] = $adherent;
            $manager->persist($adherent);
        }
        $manager->flush();

        // 5. Création des emprunts
        for ($i = 0; $i < 30; $i++) {
            // $dateEmprunt = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 years', 'now'));
            $dateEmprunt = $faker->dateTimeBetween('-1 years', 'now');

            // $dateRetour = DateTimeImmutable::createFromMutable($faker->dateTimeBetween($dateEmprunt, '+2 weeks'));
            $dateRetour = $faker->dateTimeBetween($dateEmprunt, '+2 weeks');



            $emprunt = (new Emprunt())
                ->setDateEmprunt(DateTimeImmutable::createFromMutable($dateEmprunt))
                ->setDateRetour(DateTimeImmutable::createFromMutable($dateRetour));

            // Ajout des adhérents aux emprunts
            shuffle($adherents);
            $randomAdherents = array_slice($adherents, 0, mt_rand(1, 3));
            foreach ($randomAdherents as $adherent) {
                $emprunt->setAdherent($adherent);
            }

            // Ajout d'un livre à l'emprunt	
            $livre = $livres[array_rand($livres)];
            $emprunt->setLivre($livre);

            $manager->persist($emprunt);
        }
        $manager->flush();

        // 6. Création des réservations
        for ($i = 0; $i < 10; $i++) {
            // $dateResa = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('now', '+1 month'));
            $dateResa = $faker->dateTimeBetween('now', '+1 month');


            $reservation = (new Reservations())
                ->setDateResa(DateTimeImmutable::createFromMutable($dateResa));

            // Ajout d'un adhérent à la réservation
            $adherent = $adherents[array_rand($adherents)];
            $reservation->setAdherent($adherent);

            // Ajout d'un livre à la réservation
            $livre = $livres[array_rand($livres)];
            $reservation->setLivre($livre);

            $manager->persist($reservation);
        }
        $manager->flush();
    }
}
