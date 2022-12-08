<?php


namespace App\Controller;


use App\Entity\Direction;
use App\Entity\Lecturer;
use App\Entity\StudyVariant;
use App\Entity\User;
use App\Repository\LazyLoadingRepository;
use App\Services\JsonView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LazyLoadingController
 * @package App\Controller
 *
 * @Route("/api/lazy")
 */
class LazyLoadingController extends AbstractController
{
    private $lazyLoadingRepository;

    public function __construct(LazyLoadingRepository $lazyLoadingRepository)
    {
        $this->lazyLoadingRepository = $lazyLoadingRepository;
    }

    /**
     * @Route("/curators", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getCurators()
    {
        $data = $this->lazyLoadingRepository->getEntityFieldsByNames([['id','slug'], ['user']], Lecturer::class);
        $response = new JsonView(true, $data);

        return $this->json($response->view());
    }

    public function getHeadmen()
    {
        $data = $this->lazyLoadingRepository->getEntityFieldByName('id', User::class);
        return $this->json(new JsonView(true, $data));
    }

    public function getDirections()
    {
        $data = $this->lazyLoadingRepository->getEntityFieldByName('id', Direction::class);
        return $this->json(new JsonView(true, $data));
    }

    public function getStudyVariants()
    {
        $data = $this->lazyLoadingRepository->getEntityFieldByName('id', StudyVariant::class);
        return $this->json(new JsonView(true, $data));
    }

    public function getStudents()
    {
        $data = $this->lazyLoadingRepository->getEntityFieldByName('id', User::class);
        return $this->json(new JsonView(true, $data));
    }

    /**
     * @Route("/roles", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getRolesExist()
    {
        $data = User::getRolesExist();
        $response = new JsonView();
        $response->setView(true, $data);
        return $this->json($response->view());
    }

    /**
     * @Route("/langs", methods={"GET"})
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getLanguagesExist()
    {
        $data = User::getLanguagesExist();
        $response = new JsonView();
        $response->setView(true, $data);
        return $this->json($response->view());
    }
}
