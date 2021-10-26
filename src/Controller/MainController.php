<?php

namespace App\Controller;

use App\Entity\Audience;
use App\Entity\Day;
use App\Entity\Group;
use App\Entity\Pair;
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
use App\Service\UserService;
use App\Service\ScheduleService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use function PHPSTORM_META\map;

class MainController extends AbstractController
{
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    /**
     * @Route("/",name="main")
     */
    public function index(UserService $user, ScheduleService $schedule): Response
    {
        $newUser = $user->create();
        $schedule = $schedule->create();
        return new Response($newUser);
        /*return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'user' => $newUser,
        ]);*/
    }

    /**
     * @Route("/table/{name}",name="tables")
     */
    public function showTable(string $name, UserRepository $user, 
                                            RoleRepository $role,
                                            ScheduleRepository $service,
                                            PairRepository $pair,
                                            GroupRepository $group,
                                            DayRepository $day,
                                            SubjectRepository $subject,
                                            AudienceRepository $audience) {
        $schemaManager = $this->getDoctrine()->getConnection()->getSchemaManager();
           // if ($schemaManager->tablesExist($name) == true) { // если существует таблица по заданному роуту
                if(isset($_GET['page'])) {
                    $t = $$name->findAll();
                    $paginated = $$name->findBy(array(),null,$$name->perPage,$$name->perPage * $_GET['page'] - 1 - $$name->perPage + 1);
                    return $this->render('table.html.twig', [
                        'name' => $name,
                        'pages' => count($t) / $$name->perPage,
                        'paginated' => $paginated,
                        'page' => $_GET['page']
                    ]);
                } else {
                    $t = $$name->findAll();
                    return $this->render('table.html.twig', [
                        'table' => $t,
                        'name' => $name,
                        'pages' => count($t) / $$name->perPage,
                    ]);
                }
        //} else return new Response("Таблицы $name не существует!") ;
    }
    
    /**
     * @Route("/{table}/{id}",name="model",methods={"GET"})
     */
    public function getOneModel(string $table, int $id,
                                                UserRepository $user, 
                                                RoleRepository $role,
                                                ScheduleRepository $service,
                                                PairRepository $pair,
                                                GroupRepository $group,
                                                DayRepository $day,
                                                SubjectRepository $subject,
                                                AudienceRepository $audience) {
        $schemaManager = $this->em->getConnection()->getSchemaManager();
        // array of Doctrine\DBAL\Schema\Column
        $columns = $schemaManager->listTableColumns($table);
        $columnNames = [];
        $columnValues = [];
        $modelData = $$table->findBy([
            'id' => $id
        ]);
        if(!$modelData) {
            return new Response('По указанному адресу нет сущностей');
        }
        foreach($columns as $column){
            $columnNames[] = $column->getName();
        }
        foreach($modelData as $val) {
            $columnValues[] = $val;
        }
        return $this->render('crud.html.twig', [
            'names' => $columnNames,
            'values' => $columnValues[0],
            'table' => $table,
            'id' => $id
        ]);;
    }

    /**
     * @Route("/{table}/{id}",name="modelEdit",methods={"POST"})
    */ 
    public function updateModel(string $table, int $id,
                                                Request $request,
                                                UserRepository $user, 
                                                RoleRepository $role,
                                                ScheduleRepository $service,
                                                PairRepository $pair,
                                                GroupRepository $group,
                                                DayRepository $day,
                                                SubjectRepository $subject,
                                                AudienceRepository $audience) {
        $schemaManager = $this->em->getConnection()->getSchemaManager();
        $columns = $schemaManager->listTableColumns($table);
        $columnNames = [];
        
        foreach($columns as $column){
            $colName = $column->getName();
            if(mb_substr_count($colName,"_") != 0) {
                $splitString = explode("_",$colName); // если есть _ в словах, нужно сформировать строку, в которой их нет и перевести в верхний регистр
                $colValue = implode(array_map(function($str) {
                    return ucfirst($str);
                },$splitString));
                $columnNames[] = [$colName => 'set'.$colValue]; // формируем имена сеттеров
            } else {
                $columnNames[] = [$colName => "set".ucfirst($colName)];
            }
        }
        
        $target = $$table->findBy([
            'id' => $id
        ])[0];
        
        foreach($columnNames as $field) {
            foreach($field as $fieldName => $setter) {
                $updatedField = $request->request->get($fieldName);
                if($updatedField !== "" && method_exists($target,$setter)) {
                    call_user_func(array($target,$setter),$updatedField);
                }
            }
        }
        $response = $this->em->flush();
        return new Response('Вы изменили модель. Перезагрузите страницу');                                       
    }

    /**
     * @Route("/{table}/{id}/delete",name="modelEdit",methods={"POST"})
    */ 
    public function deleteModel(string $table, int $id,
                                                UserRepository $user, 
                                                RoleRepository $role,
                                                ScheduleRepository $service,
                                                PairRepository $pair,
                                                GroupRepository $group,
                                                DayRepository $day,
                                                SubjectRepository $subject,
                                                AudienceRepository $audience) 
    {
        $deletingModel = $$table->findBy([
            'id' => $id
        ])[0];
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
        $schemaManager = $this->em->getConnection()->getSchemaManager();
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        return $this->render('tables.html.twig', [
            'tables' => $stmt->fetchAll(\PDO::FETCH_COLUMN)
        ]);
    }
}
