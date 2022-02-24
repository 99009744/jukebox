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
        return $this->render('index.html.twig', [
            'title'=> ''
        ]);
    }
}
