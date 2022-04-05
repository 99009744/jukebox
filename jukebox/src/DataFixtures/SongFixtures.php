<?php

namespace App\DataFixtures;

use App\Entity\Song;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SongFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    
        $song = new Song();
        $song->setTitle('stay');
        $song->setArtist('Kid Laroi');
        $song->setCover('build/images/stay.ae3324bd.jpg');
        $song->setTime(140);
        $song->addGenre($this->getReference('genre_1'));
        $song->addGenre($this->getReference('genre_2'));
        $song->addGenre($this->getReference('genre_3'));
        $manager->persist($song);

        $song2 = new Song();
        $song2->setTitle('old town road');
        $song2->setArtist('Lil nas x');
        $song2->setCover('build/images/old_town_road.ecad8033.jpg');
        $song2->setTime(158);
        $song2->addGenre($this->getReference('genre_2'));
        $song2->addGenre($this->getReference('genre_3'));
        $manager->persist($song2);

        $song3 = new Song();
        $song3->setTitle('Industy baby');
        $song3->setArtist('Lil nas x');
        $song3->setCover('build/images/industry_baby.0a0aad73.jpg');
        $song3->setTime(213);
        $song3->addGenre($this->getReference('genre_1'));
        $song3->addGenre($this->getReference('genre_2'));
        $manager->persist($song3);

        $song4 = new Song();
        $song4->setTitle('Money');
        $song4->setArtist('Lisa');
        $song4->setCover('build/images/money.c6289927.jpg');
        $song4->setTime(170);
        $song4->addGenre($this->getReference('genre_1'));
        $song4->addGenre($this->getReference('genre_6'));
        $manager->persist($song4);

        $song5 = new Song();
        $song5->setTitle('Kill this love');
        $song5->setArtist('BlackPink');
        $song5->setCover('build/images/kill_this_love.44e49f0a.jpg');
        $song5->setTime(170);
        $song5->addGenre($this->getReference('genre_1'));
        $song5->addGenre($this->getReference('genre_6'));
        $manager->persist($song5);

        $song6 = new Song();
        $song6->setTitle('Solo');
        $song6->setArtist('Jennie');
        $song6->setCover('build/images/solo.8565fdfd.jpg');
        $song6->setTime(177);
        $song6->addGenre($this->getReference('genre_6'));
        $manager->persist($song6);

        $song7 = new Song();
        $song7->setTitle('In the end');
        $song7->setArtist('Linking Park');
        $song7->setCover('build/images/in_the_end.276684b9.jpg');
        $song7->setTime(216);
        $song7->addGenre($this->getReference('genre_2'));
        $song7->addGenre($this->getReference('genre_4'));
        $manager->persist($song7);

        $song8 = new Song();
        $song8->setTitle('Breaking the habbit');
        $song8->setArtist('Linking Park');
        $song8->setCover('build/images/breaking_the_habit.8ff73b1b.jpg');
        $song8->setTime(199);
        $song8->addGenre($this->getReference('genre_1'));
        $song8->addGenre($this->getReference('genre_2'));
        $song8->addGenre($this->getReference('genre_4'));
        $manager->persist($song8);

        $song9 = new Song();
        $song9->setTitle('Animals');
        $song9->setArtist('Maroon 5');
        $song9->setCover('build/images/animals.97666736.jpg');
        $song9->setTime(230);
        $song9->addGenre($this->getReference('genre_3'));
        $song9->addGenre($this->getReference('genre_4'));
        $manager->persist($song9);

        $song10 = new Song();
        $song10->setTitle('Godzilla');
        $song10->setArtist('Eminem');
        $song10->setCover('build/images/godzilla.ce532e64.jpg');
        $song10->setTime(211);
        $song10->addGenre($this->getReference('genre_1'));
        $song10->addGenre($this->getReference('genre_2'));
        $manager->persist($song10);

        $song11 = new Song();
        $song11->setTitle('Dynamite');
        $song11->setArtist('BTS');
        $song11->setCover('build/images/dynamite.78a26a4a.jpg');
        $song11->setTime(223);
        $song11->addGenre($this->getReference('genre_3'));
        $song11->addGenre($this->getReference('genre_5'));
        $song11->addGenre($this->getReference('genre_6'));
        $manager->persist($song11);

        $song12 = new Song();
        $song12->setTitle('How you like that');
        $song12->setArtist('BlackPink');
        $song12->setCover('build/images/how_you_like_that.fd7fc42f.jpg');
        $song12->setTime(223);
        $song12->addGenre($this->getReference('genre_1'));
        $song12->addGenre($this->getReference('genre_3'));
        $song12->addGenre($this->getReference('genre_6'));
        $manager->persist($song12);

        $song13 = new Song();
        $song13->setTitle('Lovesick girls');
        $song13->setArtist('BlackPink');
        $song13->setCover('build/images/lovesick.588f8526.jpg');
        $song13->setTime(197);
        $song13->addGenre($this->getReference('genre_4'));
        $song13->addGenre($this->getReference('genre_6'));
        $manager->persist($song13);

        $song14 = new Song();
        $song14->setTitle('I will survive');
        $song14->setArtist('Gloria Gaynor');
        $song14->setCover('build/images/i_will_survive.a3e06189.jpg');
        $song14->setTime(244);
        $song14->addGenre($this->getReference('genre_5'));
        $manager->persist($song14);

        $song15 = new Song();
        $song15->setTitle('Tunder');
        $song15->setArtist('Gabry Ponte');
        $song15->setCover('build/images/tunder.9534d9aa.jpg');
        $song15->setTime(200);
        $song15->addGenre($this->getReference('genre_5'));
        $manager->persist($song15);

        $song16 = new Song();
        $song16->setTitle('I want love');
        $song16->setArtist('Jessie J');
        $song16->setCover('build/images/i_want_love.89a5af2c.jpg');
        $song16->setTime(233);
        $song16->addGenre($this->getReference('genre_5'));
        $manager->persist($song16);

        $song17 = new Song();
        $song17->setTitle('Holding Out For A Hero');
        $song17->setArtist('Bonnie Tyler');
        $song17->setCover('build/images/holding_out_for_a_hero.326bc22c.jpg');
        $song17->setTime(197);
        $song17->addGenre($this->getReference('genre_3'));
        $song17->addGenre($this->getReference('genre_4'));
        $manager->persist($song17);

        $song18 = new Song();
        $song18->setTitle('Revange');
        $song18->setArtist('Joyner lucas');
        $song18->setCover('build/images/revange.f099d203.jpg');
        $song18->setTime(269);
        $song18->addGenre($this->getReference('genre_1'));
        $song18->addGenre($this->getReference('genre_2'));
        $manager->persist($song18);

        $song19 = new Song();
        $song19->setTitle('Homocide');
        $song19->setArtist('Logic');
        $song19->setCover('build/images/homicide.8e781bec.jpg');
        $song19->setTime(240);
        $song19->addGenre($this->getReference('genre_1'));
        $song19->addGenre($this->getReference('genre_2'));
        $manager->persist($song19);

        $manager->flush();

        $this->addReference('song_1', $song);
        $this->addReference('song_2', $song2);
        $this->addReference('song_3', $song3);
        $this->addReference('song_4', $song4);
        $this->addReference('song_5', $song5);
        $this->addReference('song_6', $song6);
    }
}
