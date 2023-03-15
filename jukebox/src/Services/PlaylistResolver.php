<?php

namespace App\Services;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Playlist;
use App\Entity\Song;

class PlaylistResolver
{
    private $playlist = [];

    public function addToPlaylist($value): void
    {
        $this->playlist[] = $value;
    }

    public function removeFromPlaylist(Request $request): void
    {
        $value = $request->get('value');

        if (($key = array_search($value, $this->playlist)) !== false) {
            unset($this->playlist[$key]);
        }
    }

    public function isInPlaylist($value): bool
    {
        return in_array($value, $this->playlist);
    }

    public function getPlaylist(): array
    {
        return $this->playlist;
    }
}