<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    public function home()
    {
        dd("test");
    }
}