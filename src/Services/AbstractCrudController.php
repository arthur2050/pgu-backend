<?php


namespace App\Services;

use App\Exceptions\FormValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;use Symfony\Component\Routing\Annotation\Route;

abstract class AbstractCrudController extends AbstractController implements CrudControllerInterface
{

    /**
     * @Route("add/", methods={"POST"})
     */
    public function add(Request $request)
    {
        try {
            $response = $this->getItemService()->create($request);
            $view = $this->getJsonView();
            $view->setView(true, $response);

            return $this->json($view->view());
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(), $exception->getCode());
        }
    }

    /**
     * @Route("edit/{idItem}", methods={"POST"})
     */
    public function edit(Request $request, $idItem)
    {
        try {

            $response = $this->getItemService()->edit($request, $idItem);
            $view = $this->getJsonView();
            $view->setView(true, $response);

            return $this->json($view->view());
        } catch (FormValidationException $exception) {
            return new Response($exception->getErrorsResponse(), $exception->getCode());
        }
    }

    /**
     * @Route("delete/{idItem}", methods={"DELETE"})
     */
    public function delete($idItem)
    {
        $response = $this->getItemService()->delete($idItem);
        $view = $this->getJsonView();
        $view->setView(true, $response);

        return $this->json($view->view());
    }

    abstract protected function getItemService(): CrudServiceInterface;

    abstract protected function getJsonView(): AbstractJsonView;
}
