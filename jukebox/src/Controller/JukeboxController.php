<?php

namespace App\Controller;

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

    #[Route('/jukebox', name: 'jukebox')]
    public function index(SongRepository $songRepository): Response
    {
        // findAll()  - SELECT * from songs.
        // find(value) - SELECT * from songs WHERE id = value.
        // findby([], ['id' => DESC]) - Select * from songs ORDER BY id DESC.
        // findOneBy(['id' => 5,'name' -> 'stay'] ['id' => 'DESC']) 2nd is optional if you want te DESC add it, 1st is optional how many values you want. SELECT * from songs WHERE is = 5 AND name = 'Stay' ORDDER by id DESC
        // count([]) counts the repositorys. - SELECT COUNT() from songs.

        $songs = $songRepository->findAll();
        dd($songs); 

    //    $repository = $this->em->getRepository(Song::class);
    //    $songs = $repository->findAll();
       
    //     dd($songs);

        return $this->render('index.html.twig');
    }
}
