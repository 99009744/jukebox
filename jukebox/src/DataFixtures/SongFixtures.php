<?php

namespace App\DataFixtures;

use App\Entity\Song;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SongFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    
        $song = new Song();
        $song->setTitle('stay');
        $song->setArtist('Kid Laroi');
        $song->setCover('https://cdn.pixabay.com/photo/2017/11/14/16/20/fantasy-2948896_960_720.jpg');
        $song->addGenre($this->getReference('genre_1'));
        $song->addGenre($this->getReference('genre_2'));
        $song->addGenre($this->getReference('genre_3'));
        $manager->persist($song);

        $song2 = new Song();
        $song2->setTitle('old town road');
        $song2->setArtist('Lil nas x');
        $song2->setCover('https://cdn.pixabay.com/photo/2017/08/06/09/29/people-2590657_960_720.jpg');
        $song2->addGenre($this->getReference('genre_2'));
        $song2->addGenre($this->getReference('genre_3'));
        $manager->persist($song2);

        $manager->flush();

        $this->addReference('song_1', $song);
        $this->addReference('song_2', $song2);
    }
}
