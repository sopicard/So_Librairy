<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\AuthorRepository;

class AdminAuthorController extends AbstractController
{
/**
 * @Route("/admin/insert_author", name="admin_insert_author")
 */
    public function insertAuthor()
    {
       dd("author");
    }
}