<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class Session
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;

        // Accessing the session in the constructor is *NOT* recommended, since
        // it might not be accessible yet or lead to unwanted side-effects
        // $this->session = $requestStack->getSession();
    }

    // public function someMethod()
    // {
    //     $session = $this->requestStack->getSession();

    //     // stores an attribute in the session for later reuse
    //     $session->set('attribute-name', 'attribute-value');

    //     // gets an attribute by name
    //     $foo = $session->get('foo');

    //     // the second argument is the value returned when the attribute doesn't exist
    //     $filters = $session->get('filters', []);

    //     // ...
    // }
    
    public function getPlaylist()
    {
        $session = $this->requestStack->getSession();

        return $session->get('playlist');

    }
}