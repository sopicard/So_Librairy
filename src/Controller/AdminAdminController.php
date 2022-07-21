<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

//1-Création dans nelle class d'une nouvelle rte+fonction (penser use + dd)
//2-Instanciation class UserRepository puis utilisation méthode pour trouver tous les admins
// (+infos dans base de données concernant la table) avec un dd = array correspondant à la table user
//3- Pour pouvoir afficher nos données : return vers fichier twig que l'on crée : admins.html.twig
//4- Tester de nouveau la route pour avoir affichage mail + rôle (twig).
//      si l'on a le rôle admin, on a forcément le rôle user (+restrictif, "enfant" de admin)

//5- CRUD pour admin : start avec create => rte + fonction + dd
//6- Cmder => dans mon projet créer form php bin/console make:form. Form UserType crée + entité User
//7- Dans le UserType, sortir le champ rôles car à ce stade, un peu particulier à gérer (comme tableau avec choice label ..)
//      et ajouter champ "valider".
//8- Function de création du formulaire dans le controller + création fichier twig insert_admin
//      =>tester avec {{ form(form) }}
//9- Instanciation class Request => récup données dans URL
//10- Instanciation class EntityM pour pré enregistrer (persist) puis enregistrer (flush) infos dans bdd
//11- Par rapport au point 7, pour le moment solution = afficher le rôle depuis le contrôleur (setRoles)
//12- Instanciation class UserPasswordHasher.. pour que le mdp ne soit pas en clair :
//      apparaît haché en bdd  ! (penser use ..)
//13- Si form rempli et valid :on va chercher le mot de passe saisi $plainPassword = $form->get('password')->getData();
//           et  on l'affiche dd( $plainPassword);
//14- Method hashed password + dd("$hashedPassword") => verif mot de pass haché
//15- Affichage mdp hache avec fonction Set
//16- J' aurais pu ajouter dans le UserType un TextType au niveau du password avec le paramètre
//          mapped=>false pour indiquer à Doctrine que c'est moi qu gère le mot de passe
//          mais le RepeatedType indique la même chose et demande à l'utilisateur d'entrer 2 fois le mdp
//17- Ajouter un message de succès avec redirection vers la liste des admins




class AdminAdminController extends AbstractController
{
    /**
     * @Route("/admin/admins", name="admin_list_admins")
     */
    public function listAdmins(UserRepository $userRepository)
    {
        $admins = $userRepository->findAll();

        return $this->render("admin/admins.html.twig", [
            "admins" => $admins
            ]);

    }

    /**
     * @Route ("/admin/create", name="admin_create_admin")
     */
    public function createAdmin(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher)
    {
       $user = new User();
       $user->setRoles(["ROLE_ADMIN"]);

       $form = $this->createForm(UserType::class, $user);
       $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $plainPassword = $form->get('password')->getData();
            $hashedPassword = $userPasswordHasher->hashPassword($user,$plainPassword);

            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("success", " Nouvel utilisateur enregistré ! ");

            return $this->redirectToRoute("admin_list_admins");
        }
       return $this->render("admin/insert_admin.html.twig", [
           "form" => $form->createView()
       ]);
    }
}