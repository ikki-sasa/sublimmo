<?php

namespace App\DataFixtures;

use Faker;
// use Faker\Factory;
use App\Entity\Commercial;
use App\Entity\Maison;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product(); exemple par défault
        // $manager->persist($product);

        // $commercial = new Commercial(); //create a new commercial
        // $commercial->setName('Bora'); // defined the name of the commercial
        // $manager->persist($commercial); //présice au gestionnaire qu'on va voulair envoyer un objet bdd (le rend persistant / liste d'attente) 


        $faker = Faker\Factory::create(); //pour générer faux nom 
        // $faker = Factory::create();

        for ($i = 1; $i <= 5; $i++) {
            $commercial = new Commercial(); //création de l'objet
            $commercial->setName($faker->name()); // on définit les 5 noms grace la loop
            $manager->persist($commercial);
        }

        for ($i = 1; $i <= 10; $i++) {
            $maison = new Maison();
            $maison->setTitle('Maison de ' . $faker->name());
            $maison->setDescription($faker->text(255));
            $maison->setSurface($faker->numberBetween(59, 199));
            $maison->setRooms($faker->numberBetween(5, 10));
            $maison->setBedrooms($faker->numberBetween(1, 4));
            $maison->setPrice($faker->numberBetween(75000, 595000));
            $maison->setImg1('maison-1.png');
            $maison->setImg2('maison-2.png');
            $maison->setCommercial($commercial); // par défault il va prendre le dernier commercial de la boucle 
            $manager->persist($maison);
        }

        $manager->flush(); //envoit les objets persistés en bdd

        // persist() prépare une entité pour la création.cette entité va $etre liée à quelsue chose en base, même si l'user ne posera pas problème
        // flush() envoies les informations en bdd après une manipultaion d'entity que l'on veux conserver 
        // clear() fait en sorte que les entités qui auraient été récupérées depuis la bdd ne sont plus marquées comme déjà persistées. de manière simpliste supprime l'id des entités donc impossible de la mettre à jour.
    }
}
