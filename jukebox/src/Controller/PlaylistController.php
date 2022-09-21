<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\User;
use App\Entity\Playlist;
use App\Form\SavePlaylistFormType;
use App\Repository\SongRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaylistController extends AbstractController
{
    private SessionInterface $session;
    private $songRepository;

    public function __construct(RequestStack $requestStack, SongRepository $songRepository)
    {
        $this->session = $requestStack->getSession();
        $this->songRepository = $songRepository;
    }

    #[Route('/playlist', name: 'app_playlist')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $safePlaylist = $this->session->get('playlist');
        $form = $this->createForm(SavePlaylistFormType::class, $safePlaylist);
        $formName = $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            PlaylistController::safePlaylist($safePlaylist, $entityManager, $formName);
            $this->session->clear();
            $this->addFlash('saved', 'Playlist has been saved');
        }

        return $this->render('playlist/index.html.twig', [
            'playlist' => $this->session->get('playlist'),
            'controller_name' => 'PlaylistController',
            'savePlaylistForm' => $form->createView(),
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

    private function safePlaylist($playlist, EntityManagerInterface $entityManager) : void
    {
        $safePlaylist = new Playlist;
        $user = $this->getUser();
        if(!empty($user)){
            $userId = $user->getId();
            }
            
        $safePlaylist->setUserId($userId);
        $safePlaylist->setName($playlist->getName());
        foreach ( $playlist->getSongs() as $song ) {
            $safePlaylist->addSong($this->songRepository->findOneBy(['id' => $song->getId()]));
        }
        $entityManager->persist($safePlaylist);
        $entityManager->flush();

    }
}