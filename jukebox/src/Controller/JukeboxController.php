<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JukeboxController extends AbstractController
{
    #[Route('/jukebox', name: 'jukebox')]
    public function index(): Response
    {
        $songs = ['song1', 'song2', 'song3'];
        return $this->render('index.html.twig', array(
            'songs' => $songs
        ));
    }
}
