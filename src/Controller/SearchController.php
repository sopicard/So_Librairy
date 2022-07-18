<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/admin/search", name="admin_search")
     */

    public function searchBar(Request $request, AuthorRepository $authorRepository, BookRepository $bookRepository)
    {
        $search = $request->query->get("search");

        $author = $authorRepository->searchByWord($search);
        $book = $bookRepository->searchByWord($search);

        return $this->render("admin/search.html.twig", ["authorsList"=>$author, "booksList"=>$book]);
    }
}