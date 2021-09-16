<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use App\Entity\User;
use App\Entity\Role;
use App\Service\ScheduleService;

class MainController extends AbstractController
{
    /**
     * @Route("/",name="main")
     */
    public function index(UserService $user, ScheduleService $schedule): Response
    {
        $newUser = $user->create();
        $schedule = $schedule->create();
        return new Response($newUser);
        /*return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'user' => $newUser,
        ]);*/
    }
}
