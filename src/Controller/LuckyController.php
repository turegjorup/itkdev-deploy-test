<?php

namespace App\Controller;

use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LuckyController extends AbstractController
{
    /**
     * @throws RandomException
     */
    #[Route('/', name: 'app_lucky')]
    public function index(): Response
    {
        $number = random_int(0, 100);

        return $this->render('lucky/index.html.twig', [
            'number' => $number,
            'color' => $this->rand_color(),
        ]);
    }

    private function rand_color(): string
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
