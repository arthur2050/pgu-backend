<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("api/login", name="app_login")
     */
    public function login(Request $request, UserRepository $userRepository, JWTTokenManagerInterface $JWTManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        if (!$request->headers->has('authorization')) {
            $user = $userRepository->findOneBy(array('email' => $email));
        } else $user = $this->getUser();


        if (null === $user || !$passwordHasher->isPasswordValid($user, $password)) { // если не отправлены данные для входа
            return $this->json([
                'message' => 'Wrong credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->setPassword('');
        return $this->json(
            [
                'user' => $user,
                'token' => $JWTManager->create($user)
            ]
        );
    }

    /**
     * @Route("api/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
