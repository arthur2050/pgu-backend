<?php

namespace App\Controller;

use App\Entity\Audience;
use App\Entity\Day;
use App\Entity\Group;
use App\Entity\Pair;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UserRepository;
use App\Repository\RoleRepository;
use App\Repository\ScheduleRepository;
use App\Repository\GroupRepository;
use App\Repository\PairRepository;
use App\Repository\DayRepository;
use App\Repository\SubjectRepository;
use App\Repository\AudienceRepository;

use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Entity\Role;
use App\Entity\Schedule;
use App\Entity\Subject;
use App\Entity\UserRepository as EntityUserRepository;
use App\Service\GroupService;
use App\Service\RoleService;
use App\Service\UserService;
use App\Service\ScheduleService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

use function PHPSTORM_META\map;

class MainController extends AbstractController implements ServiceSubscriberInterface
{
    private $locator;


    public function __construct(EntityManagerInterface $em, 
                                ContainerInterface $locator, 
                                FormFactoryInterface $formFactoryInterface,
                                GroupService $groupService, 
                                ) {
        $this->em = $em;
        $this->locator = $locator;
        $this->groupService = $groupService;
        //$this->roleService = $roleService;
        $this->formFactoryInterface = $formFactoryInterface;
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
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/{table}",name="create", methods={"POST"})
     */
    public function create(string $table, Request $request) {
        $service = "App\\Service\\".ucfirst($table)."Service";
        if($this->locator->get($service)->create($request)) {
            return new Response('Модель была успешно добавлена');
        }
        return new Response('Модель не была создана. Проверьте параметры запроса');
    }

    /**
     * @Route("/table/{name}",name="tables", methods={"GET"})
     */
    public function showTable(string $name) {
        $repository = "App\Repository\\".ucfirst($name)."Repository";
        //$schemaManager = $this->getDoctrine()->getConnection()->getSchemaManager();
            //if ($schemaManager->tablesExist($name) == true) { // если существует таблица по заданному роуту
                $repository = $this->locator->get($repository);
                $t = $repository->findAll();
                /*if(isset($_GET['page'])) {
                    $paginated = $repository->findBy(array(),null,$repository->perPage,$repository->perPage * $_GET['page'] - 1 - $repository->perPage + 1);
                    return $this->render('table.html.twig', [
                        'name' => $name,
                        'pages' => count($t) / $repository->perPage,
                        'paginated' => $paginated,
                        'page' => $_GET['page']
                    ]);
                } else {
                    return $this->render('table.html.twig', [
                        'table' => $t,
                        'name' => $name,
                        'pages' => count($t) / $repository->perPage,
                    ]);
                }*/
                return new Response($t);
        //} else return new Response("Таблицы $name не существует!") ;
    }

    /**
     * @Route("/{table}/{id}",name="modelEdit",methods={"PUT"})
    */ 
    public function updateModel(string $table, int $id, Request $request) {
        $repository = "App\Repository\\".ucfirst($table).'Repository';
        $service = "App\Service\\".ucfirst($table).'Service';
        $target = $this->locator->get($repository)->findOneBy(['id' => $id]);
        $response = $this->locator->get($service)->update($target,$request);
        if(!$response) {
            return new Response('Не удалось провести изменение модели');
        }
        return new Response('Вы изменили модель. Перезагрузите страницу');                                       
    }
    
    
    /**
     * @Route("/{table}/{id}/show",name="model",methods={"GET"})
     */
    public function getOneModel(string $table, int $id) {
        $repository = "App\Repository\\".ucfirst($table).'Repository';
        $t = $this->locator->get($repository)->findOneBy([ 'id' => $id ]);
        return new Response($t);
    }


    /**
     * @Route("/{table}/{id}/delete",name="modelEdit",methods={"POST"})
    */ 
    public function deleteModel(string $table, int $id) 
    {
        $repository = "App\Repository\\".ucfirst($table).'Repository';
        $deletingModel = $this->container->get($repository)->findOneBy(['id' => $id]);
        $this->em->remove($deletingModel);
        $this->em->flush();
        return new Response('Вы удалили модель!');
    }

    /**
     * @Route("/tables",name="tableList",methods={"GET"})
    */ 
    public function showTables() 
    {
        $sql = "SHOW TABLES;";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->render('tables.html.twig', [
            'tables' => $stmt->fetchAll(\PDO::FETCH_COLUMN)
        ]);
    }
    
    /**
     * @Route("/api/login",name="api_login",methods={"POST"})
    */ 
    public function login(Request $request) {
        $credentials = $this->locator->get('App\Service\UserService')->login($request);
        if(isset($credentials)) {
            return $this->json($credentials);
        } else {
            return new HttpException(401, 'Неверные учетные данные');
        }
    }

    /**
     * @Route("/api/register",name="api_register",methods={"POST"})
    */ 
    public function register(Request $request) {
        $user = $this->locator->get('App\Service\UserService')->create($request);
        if($user) {
            return new Response($user);
        } else return new Response('Не удалось зарегистрироваться', 400);
    }
}
