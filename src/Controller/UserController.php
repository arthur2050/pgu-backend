<?php


namespace App\Controller;


use App\Exceptions\FormValidationException;
use App\Services\UserService;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
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
                UserService::class,
            ]
        );
    }

    /**
     * @Route("/api/register",name="api_register",methods={"POST"})
     */
    public function register(Request $request)
    {
        try {
            $ar = [
                "first" => null,
                "second" => null,
                "third" => null,
                "dr" => null
            ];
            $request->request->set("collectionF", $ar);
            $response = $this->locator->get(UserService::class)->create($request);
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
     * @Route("/change-user/{userId}", methods={"POST"})
     */
    public function changeUserSettingsInterface(Request $request, int $userId)
    {
        try {
            return $this->json(
                $this->locator->get(UserService::class)->saveUserInterfaceSettings($request, $userId)
            );
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(), $exception->getCode());
        }
    }

    /**
     * @Route("/change-user-profile/{userId}", methods={"POST"})
     */
    public function changeUserProfile(Request $request, int $userId)
    {
        try {
            return $this->json(
                [
                    'user' => $this->locator->get(UserService::class)->saveUserProfile($request, $userId)
                ]
            );
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(), $exception->getCode());
        }
    }
}