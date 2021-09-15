<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use App\Entity\User;
use App\Entity\Role;

class MainController extends AbstractController
{
    /**
     * @Route("/",name="main")
     */
    public function index(UserService $user): Response
    {
        $newUser = $user->create();
        return new Response($newUser);
        /*return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'user' => $newUser,
        ]);*/
    }
}
