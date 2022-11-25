<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
//        $languagesListe = $userRepository->findUsersWithLanguages();
//        dd($languagesListe);
//        foreach ($users as $val){
//            $languagesListe = array_push();
//        }
        return $this->render('main/liste.html.twig', [
            "users" => $users
        ]);
    }

    #[Route('/message', name: 'main_message')]
    public function message()
    {
        return $this->render('main/message.html.twig');
    }

    #[Route('/ajoutAmis/{entity}/{id} ', name: 'main_ajoutAmis')]
    public function AjoutAmis($entity, $id, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $user = $userRepository->find($entity);
        $user->addAmi($userRepository->find($id));
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('main_liste');
    }

    #[Route('/retirerAmis/{entity}/{id} ', name: 'main_retirerAmis')]
    public function RetirerAmis($entity, $id, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {

        $user = $userRepository->find($entity);
        $user->removeAmi($userRepository->find($id));
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('main_liste');
    }
}
