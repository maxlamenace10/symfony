<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use App\Entity\LieuInsolite;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $lieu = new LieuInsolite();
            $lieu->setNom($faker->Nom);
            $lieu->setUser($faker->userNom);
            $lieu->setDescription($faker->userPrenom);
            $lieu->setLatitude($faker->latitude);
            $lieu->setLongitude($faker->longitude);
            $lieu->getPhotos($faker->photos);


            $manager->persist($lieu);
        }

        $manager->flush();
    }
}