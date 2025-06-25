<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class RedirectController
{
    #[Route('/', name: 'homepage')]
    public function index(): RedirectResponse
    {
        return new RedirectResponse('/login');
    }
}
