<?php

namespace App\Controller;

use App\Entity\Song;
use App\Repository\SongRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JukeboxController extends AbstractController
{
    // private $em;
    // public function __construct(EntityManagerInterface $em)
    // {
    //     $this->em = $em;
    // }

    private $songRepository;
    public function __construct(SongRepository $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    #[Route('/jukebox', methods: ['GET'], name: 'jukebox')]
    public function index(): Response
    {
        // findAll()  - SELECT * from songs.
        // find(value) - SELECT * from songs WHERE id = value.
        // findby([], ['id' => DESC]) - Select * from songs ORDER BY id DESC.
        // findOneBy(['id' => 5,'name' -> 'stay'] ['id' => 'DESC']) 2nd is optional if you want te DESC add it, 1st is optional how many values you want. SELECT * from songs WHERE is = 5 AND name = 'Stay' ORDDER by id DESC
        // count([]) counts the repositorys. - SELECT COUNT() from songs.
    //    $repository = $this->em->getRepository(Song::class);
    //    $songs = $repository->findAll();
        
        return $this->render('jukebox/index.html.twig', [
            'songs' => $this->songRepository->findAll()
        ]);
    }

    #[Route('/jukebox/{id}', methods: ['GET'], name: 'song')]
    public function show($id): Response
    {
        $song = $this->songRepository->find($id);

        return $this->render('jukebox/show.html.twig', [
            'song' => $song
        ]);
    }
}
