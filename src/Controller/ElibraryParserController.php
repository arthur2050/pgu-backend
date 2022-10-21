<?php


namespace App\Controller;

use App\Services\ElibraryHelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ElibraryParserController
 * @package App\Controller
 * @Route("api/elibrary")
 */
class ElibraryParserController extends AbstractController
{
    private $elibraryHelperService;

    public function __construct(ElibraryHelperService $elibraryHelperService)
    {
        $this->elibraryHelperService = $elibraryHelperService;
    }

    /**
     * @Route("/first", methods={"GET"})
     */
    public function getFirstPage(Request $request)
    {
        return $this->json([
            'data' => $this->elibraryHelperService->setData()
        ]);
    }
}