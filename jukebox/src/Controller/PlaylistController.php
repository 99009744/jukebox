<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\Playlist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\jukebox;

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
        if(!$playlist instanceof Playlist) {
            $playlist = new Playlist();
        }
        
        if(null !== $playlist->getSongWithId($song->getId())) {
            $this->addFlash('fail', $song->getArtist() . ' - ' .  $song->getTitle() . ' is already in your playlist');
            
            return $this->redirectToRoute('jukebox');
        }
        
        $playlist->addSong($song);
        $this->session->set('playlist', $playlist);
        $this->addFlash('success', $song->getArtist() . ' - ' .  $song->getTitle() . ' Has been added to your playlist');
        
        return $this->redirectToRoute('jukebox');
    }

    #[Route('/playlist/remove/{song}', name: 'app_playlist_remove', methods:['GET', 'DELETE'])]
    public function removeSongFromPlaylist(Song $song) : Response
    {
        $playlist = $this->session->get('playlist');
        if(null !== $playlist->getSongWithId($song->getId())) {
            $removeSong = $playlist->getSongWithId($song->getId());
            $playlist->removeSong($removeSong);
        }
        
        return $this->redirectToRoute('app_playlist');
    }
}