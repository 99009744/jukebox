<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\Playlist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaylistController extends AbstractController
{
    private SessionInterface $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    #[Route('/playlist', name: 'app_playlist')]
    public function index(): Response
    {
        return $this->render('playlist/index.html.twig', [
            'playlist' => $this->session->get('playlist'),
            'controller_name' => 'PlaylistController',
        ]);
    }

    #[Route('/playlist/add/{song}', name: 'app_playlist_add')]
    public function addSong(Song $song)
    {
        $playlist = $this->session->get('playlist');
        if(!$playlist instanceof Playlist)
        {
            $playlist = new Playlist();
        }
        
        if($playlist->containsSongWithId($song->getId())) 
        {
            return new Response('Nummer komt al voor');
        }
        
        $playlist->addSong($song);
        $this->session->set('playlist', $playlist);
        
        return new Response('Nummer is toegevoegd');
    }
}
