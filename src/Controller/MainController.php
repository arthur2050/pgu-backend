<?php

namespace App\Controller;
use App\Exceptions\FormValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\GroupService;
use App\Service\UserService;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class MainController extends AbstractController implements ServiceSubscriberInterface
{
    private $locator;


    public function __construct(ContainerInterface $locator
    )
    {
        $this->locator = $locator;
    }

    public static function getSubscribedServices()
    {
        return [
            UserService::class,
            GroupService::class,
        ];
    }

    /**
     * @Route("/",name="main")
     */
    public function index(Request $request): Response
    {
        /*$userService = $this->locator->get('App\Service\UserService');
        return new Response($userService->create($request));*/
//        return $this->render('main/index.html.twig', [
//            'controller_name' => 'MainController',
//        ]);
        return new Response("It's all good");
    }

    /**
     * @Route("/api/login",name="api_login",methods={"POST"})
     */
    public function login(Request $request)
    {
        $credentials = $this->locator->get(UserService::class)->login($request);
        if (isset($credentials)) {
            return $this->json($credentials);
        } else {
            return new HttpException(401, 'Неверные учетные данные');
        }
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
            $request->request->set("collectionF",$ar);
            $user = $this->locator->get(UserService::class)->create($request);
            return new Response($user);
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(),$exception->getCode());
        }
    }
}
