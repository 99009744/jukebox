<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PlaylistResolver
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function addToPlaylist($songId)
    {
        $playlist = $this->session->get('playlist', []);
        $playlist[] = $songId;
        $this->session->set('playlist', $playlist);
    }

    public function removeFromPlaylist($songId)
    {
        $playlist = $this->session->get('playlist', []);
        $key = array_search($songId, $playlist);
        if ($key !== false) {
            array_splice($playlist, $key, 1);
            $this->session->set('playlist', $playlist);
        }
    }

    public function getPlaylist()
    {
        return $this->session->get('playlist', []);
    }
}