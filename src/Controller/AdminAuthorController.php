<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\BookRepository;

class AdminAuthorController extends AbstractController
{
    /**
     * @Route("/admin/author/{id}", name="admin_author")
     */
    public function showAuthor($id, AuthorRepository $authorRepository)
    {
        $author = $authorRepository->find($id);

        return $this->render("admin/author.html.twig", ["author" => $author]);
    }

    /**
     * @Route("/admin/authorsList", name="admin_authorsList")
     */
    public function showAuthors(AuthorRepository $authorsRepository)
    {
        $authorsList = $authorsRepository->findall();

        return $this->render("admin/authorsList.html.twig", ["authorsList" => $authorsList]);
    }

    /**
     * @Route("/admin/insert_author", name="admin_insert_author")
     */
    public function insertAuthor(EntityManagerInterface $entityManager, Request $request)
    {
        $author = new Author();

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($author);
            $entityManager->flush();

            $this->addFlash("success", " Nouvel auteur enregistré ! ");
        }
        return $this->render('admin/insert_author.html.twig', ['form'=> $form->createView()]);
    }

    /**
     * @Route("/admin/authorsList/update/{id}", name="admin_update_author")
     */
    public function updateAuthor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $author = $authorRepository->find($id);

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($author);
            $entityManager->flush();

            $this->addFlash("success", " Auteur modifié ! ");
        }

        return $this->render("admin/update_author.html.twig", [
            "form" => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/authorsList/delete/{id}", name="admin_delete_author")
     */
    public function deleteAutor($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        $author=$authorRepository->find($id);
        if(!is_null($author)) {
            $entityManager->remove($author);
            $entityManager->flush();

            $this->addFlash("success","Cet auteur a bien été supprimé !");
        }else{
            $this->addFlash("error","Cet auteur est déjà supprimé !");

        }
        return $this->redirectToRoute("admin_authorsList");
    }
}