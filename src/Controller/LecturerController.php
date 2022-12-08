<?php


namespace App\Controller;


use App\Repository\LecturerRepository;
use App\Services\LecturerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LecturerController
 * @package App\Controller
 *
 */
class LecturerController extends AbstractController
{
    private $lecturerRepository;

    public function __construct(LecturerService $lecturerRepository)
    {
        $this->lecturerRepository = $lecturerRepository;
    }

    /**
     * @Route("api/lecturer/all/", methods={"GET"})
     */
    public function getAll()
    {
        $data = $this->lecturerRepository->findAllandHiddenPass();
        return $this->json(
            [
                'lecturers' => $data
            ]
        );
    }
}
