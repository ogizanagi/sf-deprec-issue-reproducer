<?php

namespace App\Controller;

use App\Foo;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    #[Route('/')]
    public function home()
    {
        new Foo();

        return new Response('<body><br/>'.__METHOD__.'</body>');
    }
}
