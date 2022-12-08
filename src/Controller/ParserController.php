<?php


namespace App\Controller;

use App\Services\ElibraryHelperService;
use App\Services\RFPGUApi\ParserHelperInterface;
use App\Services\RFPGUApi\RFPGUParserHelperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ParserController
 * @package App\Controller
 * @Route("api/parser")
 */
class ParserController extends AbstractController
{
    private $elibraryHelperService;
    private $rfpguParserHelper;

    public function __construct(ParserHelperInterface $elibraryHelperService, ParserHelperInterface $rfpguParserHelper)
    {
        $this->elibraryHelperService = $elibraryHelperService;
        $this->rfpguParserHelper    = $rfpguParserHelper;
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function getFirstPage(Request $request)
    {
//        return $this->json([
//            'data' => $this->elibraryHelperService->setData()
//        ]);
    }

    /**
     * @Route("/pgu", methods={"GET"})
     */
    public function getFromRFPGU()
    {
        return $this->json([
            'data' => $this->rfpguParserHelper->initialize()
        ]);
    }
}
