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

        $genre2 = new Genre();
        $genre2->setGenre('Rap');
        $manager->persist($genre2);

        $genre3 = new Genre();
        $genre3->setGenre('Pop');
        $manager->persist($genre3);

        $manager->flush();

        $this->addReference('genre_1', $genre);
        $this->addReference('genre_2', $genre2);
        $this->addReference('genre_3', $genre3);
    }
}
