<?php


namespace App\Controller;


use App\Exceptions\FormValidationException;
use App\Services\UserService;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserInterfaceController extends AbstractController
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
}
