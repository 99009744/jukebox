<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $genre = new Genre();
        $genre->setGenre('Hip Hop');
        $manager->persist($genre);

        $genre = new Genre();
        $genre->setGenre('Rap');
        $manager->persist($genre);

        $genre = new Genre();
        $genre->setGenre('Pop');
        $manager->persist($genre);

        $manager->flush();
    }
}
