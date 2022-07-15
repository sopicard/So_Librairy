<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookRepository;

class AdminBookController extends AbstractController
{
    /**
     * @Route("/admin/insert_book", name="admin_insert_book")
     */
    public function insertBook()
    {
        dd("book");
    }
}