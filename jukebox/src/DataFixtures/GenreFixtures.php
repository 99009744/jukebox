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

        $genre4 = new Genre();
        $genre4->setGenre('Rock');
        $manager->persist($genre4);

        $genre5 = new Genre();
        $genre5->setGenre('Disco');
        $manager->persist($genre5);

        $genre6 = new Genre();
        $genre6->setGenre('Kpop');
        $manager->persist($genre6);

        $manager->flush();

        $this->addReference('genre_1', $genre);
        $this->addReference('genre_2', $genre2);
        $this->addReference('genre_3', $genre3);
        $this->addReference('genre_4', $genre4);
        $this->addReference('genre_5', $genre5);
        $this->addReference('genre_6', $genre6);
    }
}
