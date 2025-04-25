<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class RandomController
{

    #[Route('/random/integer')]
    public function integer(): Response
    {
        return new Response(
            json_encode([
                'random' => random_int(1, 100),
            ]),
            Response::HTTP_OK,

            [
                'Content-Type' => 'application/json',
            ]
        );
    }
}
