<?php


namespace App\Controller;


use App\Services\AbstractCrudController;
use App\Services\AbstractJsonView;
use App\Services\CrudServiceInterface;
use App\Services\JsonView;
use App\Services\UserService;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserCrudController
 * @package App\Controller
 * @Route("user/")
 */
class UserCrudController extends AbstractCrudController
{

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
     * @Route("all/", methods={"GET"})
     */
    public function getAll()
    {
        $data = $this->getItemService()->findAllandHiddenPass();
        return $this->json(
            [
                'users' => $data
            ]
        );
    }

    protected function getItemService(): CrudServiceInterface
    {
        return $this->container->get(UserService::class);
    }

    protected function getJsonView(): AbstractJsonView
    {
        return new JsonView();
    }
}
