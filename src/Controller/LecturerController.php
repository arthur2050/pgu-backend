<?php


namespace App\Controller;


use App\Exceptions\FormValidationException;
use App\Repository\LecturerRepository;
use App\Services\LecturerService;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class LecturerController
 * @package App\Controller
 * @Route("lecturer/")
 */
class LecturerController extends AbstractController
{
    private $locator;

    public function __construct(ContainerInterface $locator
    )
    {
        $this->locator = $locator;
    }

    public static function getSubscribedServices()
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                LecturerService::class,
                LecturerRepository::class
            ]
        );
    }

    /**
     * @Route("add/", methods={"POST"})
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function add(Request $request)
    {
        try {
            $response = $this->locator->get(LecturerService::class)->create($request);
            return $this->json(
                [
                    "success" => $response
                ]
            );
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(), $exception->getCode());
        }
    }

    /**
     * @Route("edit/{idLecturer}", methods={"POST"})
     * @param Request $request
     * @param $idLecturer
     * @return JsonResponse|Response
     */
    public function edit(Request $request, $idLecturer)
    {
        try {
//            dump($idLecturer);die();
            $response = $this->locator->get(LecturerService::class)->edit($request, $idLecturer);
            return $this->json(
                [
                    "success" => $response
                ]
            );
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(), $exception->getCode());
        }
    }

    /**
     * @Route("delete/{idLecturer}", methods={"DELETE"})
     * @param $idLecturer
     * @return JsonResponse|Response
     */
    public function delete($idLecturer)
    {
            $response = $this->locator->get(LecturerService::class)->delete($idLecturer);
            return $this->json(
                [
                    "success" => $response
                ]
            );
    }

    /**
     * @Route("show/{idLecturer}", methods={"GET"})
     * @param $idLecturer
     * @return JsonResponse
     */
    public function show($idLecturer)
    {
        $response = $this->locator->get(LecturerService::class)->show($idLecturer);
        return $this->json(
            [
                "success" => $response
            ]
        );
    }

    /**
     * @Route("all/", methods={"GET"})
     */
    public function getAll()
    {
        $data = $this->locator->get(LecturerService::class)->findAllandHiddenPass();
        return $this->json(
            [
                'lecturers' => $data
            ]
        );
    }

}
