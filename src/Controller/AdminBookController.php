<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookRepository;

class AdminBookController extends AbstractController
{
    /**
     * @Route("/admin/book/{id}", name="admin_book")
     */
    public function showBook($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render("admin/book.html.twig", ["book" => $book]);
    }

    /**
     * @Route("/admin/booksList", name="admin_booksList")
     */
    public function showBooks(BookRepository $booksRepository)
    {
        $booksList = $booksRepository->findAll();

        return $this->render("admin/booksList.html.twig", ["booksList" => $booksList]);
    }
    /**
     * @Route("/admin/insert_book", name="admin_insert_book")
     */
    public function insertBook(EntityManagerInterface $entityManager,Request $request)
    {
        $book = new Book();

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($book);
            $entityManager->flush();

            $this->addFlash("success", " Nouveau livre enregistré ! ");


        }
        return $this->render('admin/insert_book.html.twig', ['form'=> $form->createView()]);
    }

    /**
     * @Route("/admin/booksList/update/{id}", name="admin_update_book")
     */
    public function updateBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $book = $bookRepository->find($id);

        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($book);
            $entityManager->flush();

            $this->addFlash("success", " Livre modifié ! ");
        }

        return $this->render("admin/update_book.html.twig", [
            "form" => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/booksList/delete/{id}", name="admin_delete_book")
     */
    public function deleteBook($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        $book=$bookRepository->find($id);
        if(!is_null($book)) {
            $entityManager->remove($book);
            $entityManager->flush();

            $this->addFlash("success","Cet livre a bien été supprimé !");
        }else{
            $this->addFlash("error","Cet livre est déjà supprimé !");

        }
        return $this->redirectToRoute("admin_booksList");
    }
}