<?php

namespace App\Service;

use App\Entity\User;
use App\Exceptions\FormValidationException;
use App\Form\Type\UserRegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService implements ServiceSubscriberInterface
{

    private $roleService;
    private $entityManager;
    private $groupService;
    private $validator;
    private $locator;
    private $formFactoryInterface;
    private $passwordHasher;
    private $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        RoleService $role,
        GroupService $group,
        ValidatorInterface $validator,
        ContainerInterface $locator,
        FormFactoryInterface $formFactoryInterface,
        UserPasswordHasherInterface $passwordHasher)
    {
        $this->roleService = $role;
        $this->entityManager = $entityManager;
        $this->groupService = $group;
        $this->validator = $validator;
        $this->locator = $locator;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;

    }

    public static function getSubscribedServices()
    {
        return [
            RoleService::class,
            GroupService::class,
        ];
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    public function create(Request $request)
    {
        $user = new User();
        $form = $this->formFactoryInterface->create(UserRegistrationType::class, $user);
//        $form->handleRequest($request);
        $form->submit($request->request->all());



//        $user->setName($request->request->get('name') ?? null);
//        $user->setPhone($request->request->get('phone') ?? null);
//        $user->setEmail($request->request->get('email'));
//        $user->setSurname($request->request->get('surname') ?? null);
//        $user->setPassword($this->passwordHasher->hashPassword($user, $request->request->get('password')));
//        $user->setAvatarPath($request->request->get('avatar_path') ?? null);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return json_encode($user);
        } else {
            throw new FormValidationException($form);
        }
    }

    public function login(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $user = $this->userRepository->findOneBy(array('email' => $email));

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            throw new AccessDeniedHttpException();
        } else {
            $token = mb_convert_encoding(bin2hex(random_bytes(10)), 'UTF-8', 'UTF-8'); // как-то создать API-токен для $user
            return [
                'user' => $user->getUserIdentifier(),
                'token' => $token,
            ];
        }
    }
}