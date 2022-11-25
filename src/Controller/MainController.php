<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('', name: 'main_home')]
    public function home()
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/liste', name: 'main_liste')]
    public function liste(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        return $this->render('main/liste.html.twig', [
            "users" => $users
        ]);
    }

    #[Route('/message', name: 'main_message')]
    public function message()
    {
        return $this->render('main/message.html.twig');
    }

    #[Route('/ajoutAmis', name: 'main_ajoutAmis')]
    public function AjoutAmis(EntityManagerInterface $entityManager)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user->getUsername();
//        $user->addAmi($userFriend->getId());
//        $entityManager->persist($user);
//        $entityManager->flush();

        return $this->redirectToRoute('main_liste');

        //return $this->render('main/amis.html.twig');
    }
}
