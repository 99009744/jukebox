<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\User;
use App\Entity\Playlist;
use App\Services\PlaylistResolver;
use App\Form\SavePlaylistFormType;
use App\Repository\SongRepository;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaylistController extends AbstractController
{
    private SessionInterface $session;
    private $songRepository;
    private $playlistRepository;

    public function __construct(RequestStack $requestStack, SongRepository $songRepository, PlaylistRepository $playlistRepository)
    {
        $this->session = $requestStack->getSession();
        $this->songRepository = $songRepository;
        $this->playlistRepository = $playlistRepository;
    }

    #[Route('/playlist', name: 'app_playlist')]
    public function index(Request $request, EntityManagerInterface $entityManager, PlaylistResolver $playlistResolver): Response
    {
        // $newPlaylist = Session::class::getPlaylist();
        // dd($newPlaylist);
        $safePlaylist = $playlistResolver->getPlaylist();
        dd($playlistResolver);

        $form = $this->createForm(SavePlaylistFormType::class, $safePlaylist);
        $formName = $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            PlaylistController::safePlaylist($safePlaylist, $entityManager, $formName);
            $this->session->clear();
            $this->addFlash('saved', 'Playlist has been saved');
        }

        return $this->render('playlist/index.html.twig', [
            'playlist' => $playlistResolver->getPlaylist(),
            'controller_name' => 'PlaylistController',
            'savePlaylistForm' => $form->createView(),
        ]);
    }

    #[Route('/playlist/add/{song}', name: 'app_playlist_add')]
    public function addSong(Song $song)
    {
        $playlistResolver = new PlaylistResolver();

        $value = $song->getId();

        if ($playlistResolver->isInPlaylist($value)) {
            // Value is already in playlist
            $this->addFlash('fail', $song->getArtist() . ' - ' .  $song->getTitle() . ' is already in your playlist');
            
            return $this->redirectToRoute('jukebox');
        } else {
            $playlistResolver->addToPlaylist($value);
            $this->addFlash('success', $song->getArtist() . ' - ' .  $song->getTitle() . ' Has been added to your playlist');
            return $this->redirectToRoute('jukebox');
        }
    }

    #[Route('/playlist/remove/{song}', name: 'app_playlist_remove', methods:['GET', 'DELETE'])]
    public function removeSongFromPlaylist(Song $song, Session $session) : Response
    {
        $playlist = $session->getPlaylist();
        if(null !== $playlist->getSongWithId($song->getId())) {
            $removeSong = $playlist->getSongWithId($song->getId());
            $playlist->removeSong($removeSong);
        }
        
        return $this->redirectToRoute('app_playlist');
    }

    private function safePlaylist($playlist, EntityManagerInterface $entityManager) : void
    {
        $playlistId = $playlist->getId();
        $safePlaylist = new Playlist;
        $user = $this->getUser();
        
        if(!empty($user)) {
            $userId = $user->getId();
        }

        if(!empty($playlistId)) {
            $oldPlaylist= $this->playlistRepository->find($playlistId);
            $oldPlaylist->getId();
            $this->playlistRepository->remove($oldPlaylist);
        }

        $safePlaylist->setUserId($userId);
        $safePlaylist->setName($playlist->getName());
        foreach ( $playlist->getSongs() as $song ) {
            $safePlaylist->addSong($this->songRepository->findOneBy(['id' => $song->getId()]));
        }
        
        $entityManager->persist($safePlaylist);
        $entityManager->flush();

    }

    #[Route('/myPlaylists', name: 'app_myplaylists')]
    public function showAllPlaylistsFromUser(): Response
    {
        $user = $this->getUser();
        if(!empty($user)){
            $userId = $user->getId();
            }
        $playlists = $this->playlistRepository->findBy(['userId' => $userId]);
        return $this->render('playlist/playlists.html.twig', [
            'playlists' => $playlists
        ]);
    }

    #[Route('/myPlaylist/{id}', methods:['GET'], name: 'app_myplaylist')]
    public function showOnePlaylist($id): Response
    {
        $playlist = $this->playlistRepository->find($id);

        return $this->render('playlist/show.html.twig', [
            'playlist' => $playlist
        ]);
    }

    #[Route('/playlist/{playlistId}', methods:['GET'], name: 'app_load_playlist')]
    public function loadPlaylistToSession($playlistId, Session $session) : Response
    {
        $loadPlaylist = $this->playlistRepository->find($playlistId);
        $playlist = $session->getPlaylist();

        if(!$playlist instanceof Playlist) {
            $playlist = new Playlist();
        }

        foreach ( $loadPlaylist->getSongs() as $song ) {
            $playlist->addSong($loadPlaylist->getSongWithId($song->getId()));
        }
        $playlist->setName($loadPlaylist->getName());
        $playlist->setId($loadPlaylist->getId());
        $playlist->setUserId($loadPlaylist->getUserId());
        
        $this->session->set('playlist', $playlist);

        return $this->redirectToRoute('jukebox',[
        'playlist' => $session->getPlaylist()]);
    }
}