<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{

    /**
     * @Route("/",name="main")
     */
    public function index(Request $request): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('main/index.html.twig');
    }


    /**
     * @Route("/dashboard", methods={"GET", "OPTIONS"})
     */
    public function dashboard()
    {
        $user = $this->getUser();
        $this->denyAccessUnlessGranted("ROLE_USER");
//        return $this->render("dashboard.html.twig");
        return $this->json('dashboard');
    }
}
