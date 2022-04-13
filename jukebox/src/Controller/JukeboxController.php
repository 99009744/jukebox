<?php

namespace App\Controller;

use App\Entity\Song;
use App\Form\SongFormType;
use App\Repository\SongRepository;
use App\Repository\GenreRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JukeboxController extends AbstractController
{
    // private $em;
    // public function __construct(EntityManagerInterface $em)
    // {
    //     $this->em = $em;
    // }
    private $em;
    private $songRepository;
    private $genreRepository;
    public function __construct(SongRepository $songRepository, GenreRepository $genreRepository, EntityManagerInterface $em)
    {
        $this->songRepository = $songRepository;
        $this->genreRepository = $genreRepository;
        $this->em = $em;
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
            'songs' => $this->songRepository->findAll(),
            'genres' =>$this->genreRepository->findAll()
        ]);
    }

    #[Route('/songs/create', name: 'create_song')]
    public function create(Request $request): Response
    {
        $song = new Song();
        $form = $this->createForm(SongFormType::class, $song);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $newSong = $form->getData();

            $imagePath = $form->get('cover')->getData();
            if ($imagePath){
                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try{
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch(FileException $e){
                    return new Response($e->getMessage());
                } 
                    $newSong->setCover('uploads/' . $newFileName);
            }
            $this->em->persist($newSong);
            $this->em->flush();

            return $this->redirectToRoute('song', ['id' => $newSong->getId()]);
        }

        return $this->render('jukebox/create.html.twig',[
            'form' => $form->createView()
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
