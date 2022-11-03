<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\UserInterfaceSettings;
use App\Exceptions\FormValidationException;
use App\Form\Type\UserEditFormType;
use App\Form\Type\UserInterfaceSettingsType;
use App\Form\Type\UserRegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService implements ServiceSubscriberInterface
{

    private $entityManager;
    private $formFactoryInterface;
    private $passwordHasher;
    private $userRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        FormFactoryInterface $formFactoryInterface,
        UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->passwordHasher = $passwordHasher;
        $this->userRepository = $userRepository;

    }

    public static function getSubscribedServices()
    {
        return [];
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    public function create(Request $request, $mode = 'save') //создаём пользователя в базе
    {
        $user = new User();
        $form = $this->formFactoryInterface->create(UserRegistrationType::class, $user);

        $form->submit($request->request->all());

//        $user->setName($request->request->get('name') ?? null);
//        $user->setPhone($request->request->get('phone') ?? null);
//        $user->setEmail($request->request->get('email'));
//        $user->setSurname($request->request->get('surname') ?? null);
//        $user->setPassword($this->passwordHasher->hashPassword($user, $request->request->get('password')));
//        $user->setAvatarPath($request->request->get('avatar_path') ?? null);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, $user->getPassword())
            );
            /**
             * Задаём стандартные настройки пользовательского интерфеса
             */
            $userInterfaceSettings = new UserInterfaceSettings();
            $userInterfaceSettings->setColorFilters(0);
            $userInterfaceSettings->setColorBackground(2);
            $userInterfaceSettings->setDarkMode(false);
            $userInterfaceSettings->setSidebarMini(false);
            $userInterfaceSettings->setSidebarImage(false);
            $userInterfaceSettings->setSelectedImage(null);
            $user->setInterfaceSettings($userInterfaceSettings);
            if(!strcmp($mode,'return_without_save')) {
                return $user;
            }
            else if(!strcmp($mode,'save')) {
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                return $user;
            }

        } else {
            throw new FormValidationException($form);
        }

    }

    public function saveUserInterfaceSettings(Request $request, int $userId) //сохранение настроек пользовательского инерфейса
        //в базе
    {
        $userInterfaceSettings = new UserInterfaceSettings();
        $form = $this->formFactoryInterface->create(UserInterfaceSettingsType::class, $userInterfaceSettings);

        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $foundUser = $this->userRepository->findOneBy(['id' => $userId]);
//            $foundUser->setPassword('test1234');
//            $foundUser->setPassword($this->passwordHasher->hashPassword($foundUser, $foundUser->getPassword()));
            /*** @var $foundUserInterfaceSettings UserInterfaceSettings ** */
            $foundUserInterfaceSettings = $foundUser->getInterfaceSettings();
            $foundUserInterfaceSettings->setColorFilters($userInterfaceSettings->getColorFilters());
            $foundUserInterfaceSettings->setColorBackground($userInterfaceSettings->getColorBackground());
            $foundUserInterfaceSettings->setDarkMode((int)$userInterfaceSettings->getDarkMode());
            $foundUserInterfaceSettings->setSidebarMini((int)$userInterfaceSettings->getSidebarMini());
            $foundUserInterfaceSettings->setSidebarImage((int)$userInterfaceSettings->getSidebarImage());
            $foundUserInterfaceSettings->setSelectedImage($foundUserInterfaceSettings->getSelectedImage());
            $this->entityManager->persist($foundUser);
            $this->entityManager->flush();
            return true;
        } else {
            throw new FormValidationException($form);
        }
    }

    public function saveUserProfile(Request $request, int $userId, $email = null,  $mode = 'save') //сохраняем настройки пользовательского профиля в базе
    {
        $emailValue = null;
        if(!isset($email)) {
            $emailValue = $request->request->get('email'); //при условии что мы просто отправили данные пользователя
        } else $emailValue = $email;
        $existUser = $this->userRepository->findOneBy(['email' => $emailValue]);
        $changeableUser = $this->userRepository->findOneBy(['id' => $userId]);
        if ($existUser != null && (strcmp($changeableUser->getEmail(), $existUser->getEmail()) !== 0)) {
            throw new HttpException(400, 'This user email already exist.');
        }
        $form = $this->formFactoryInterface->create(UserEditFormType::class, $changeableUser);

        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {

            if(!strcmp($mode,'return_without_save')) {
                return $changeableUser;
            }
            else if(!strcmp($mode,'save')) {
                $this->entityManager->persist($changeableUser);
                $this->entityManager->flush();
            }
            $changeableUser->setPassword('');
            return $changeableUser;
        } else {
            throw new FormValidationException($form);
        }
    }
}
