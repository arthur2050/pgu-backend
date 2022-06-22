<?php

namespace App\Services;


use App\Entity\Lecturer;
use App\Exceptions\FormValidationException;
use App\Form\Type\LecturerCreateFormType;
use App\Form\Type\LecturerEditFormType;
use App\Repository\LecturerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LecturerService
{
    private $entityManager;
    private $lecturerRepository;
    private $formFactoryInterface;
    private $fileUploaderService;
    private $userService;

    public function __construct(
        EntityManagerInterface $entityManager,
        LecturerRepository $lecturerRepository,
        FormFactoryInterface $formFactoryInterface,
        FileUploaderService $fileUploaderService,
        UserService $userService)
    {
        $this->entityManager = $entityManager;
        $this->lecturerRepository = $lecturerRepository;
        $this->formFactoryInterface = $formFactoryInterface;
        $this->fileUploaderService = $fileUploaderService;
        $this->userService = $userService;
    }

    public function create(Request $request)
    {
        $lecturer = new Lecturer();
        $form = $this->formFactoryInterface->create(LecturerCreateFormType::class, $lecturer);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userService->create($request);
            $lecturer->setUser($user);
            $avatarPathFile = $request->files->get('avatarPath');
            if (isset($avatarPathFile)) {
                $avatarPath = $this->fileUploaderService->upload($avatarPathFile);
                $lecturer->getUser()->setAvatarPath($avatarPath);
            }
            $cardPathFile = $request->files->get('cardImage');
            if (isset($cardPathFile)) {
                $cardPath = $this->fileUploaderService->upload($cardPathFile);
                $lecturer->setCardImage($cardPath);
            }
            $this->entityManager->persist($lecturer);
            $this->entityManager->flush();
            return true;
        } else {
            throw new FormValidationException($form);
        }
    }

    public function edit(Request $request, int $idLecturer)
    {
        $lecturer  = $this->lecturerRepository->findOneBy(['id' => $idLecturer]);
        $foundLecturer = clone $lecturer;

        $form = $this->formFactoryInterface->create(LecturerEditFormType::class, $lecturer);
        $form->submit($request->request->all());

        if ($form->isSubmitted() && $form->isValid()) {
            $userEmail = $lecturer->getUser()->getEmail();
            $userId = $lecturer->getUser()->getId();
            $user = $this->userService->saveUserProfile($request, $userId , $userEmail , 'return_without_save');
            $avatarPathFile = $request->files->get('avatarPath');
            if (isset($avatarPathFile)) {
                $avatarPath = $this->fileUploaderService->upload($avatarPathFile);
                $lecturer->getUser()->setAvatarPath($avatarPath);
            } else {
                $lecturer->getUser()->setAvatarPath($foundLecturer->getUser()->getAvatarPath());
            }
            $cardPathFile = $request->files->get('cardImage');
            if (isset($cardPathFile)) {
                $cardPath = $this->fileUploaderService->upload($cardPathFile);
                $lecturer->setCardImage($cardPath);
            }else {
                $lecturer->setCardImage($foundLecturer->getCardImage());
            }
            $this->entityManager->persist($lecturer);
            $this->entityManager->flush();
            return true;
        } else {
            throw new FormValidationException($form);
        }
    }

    public function delete(int $idLecturer)
    {
        $deletedLecturer = $this->lecturerRepository->findOneBy(['id' => $idLecturer]);
        if ($deletedLecturer) {
            $this->entityManager->remove($deletedLecturer);
            $this->entityManager->flush();
            return true;
        }
        throw new HttpException(400, "No lecturer found");
    }

    public function show(int $idLecturer)
    {

        $showedLecturer = $this->lecturerRepository->findOneBy(['id' => $idLecturer]);
        if ($showedLecturer) {
            return $showedLecturer;
        } else return false;
    }

    public function findAllandHiddenPass()
    {
        $lecturers = $this->lecturerRepository->findAll();
        foreach ($lecturers as &$lecturer) {
            $lecturer->getUser()->setPassword('');
        }
        return $lecturers;
    }
}