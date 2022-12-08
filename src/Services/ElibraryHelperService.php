<?php


namespace App\Services;

use App\Services\RFPGUApi\ParserHelperInterface;

/**
 * Class ElibraryHelperService
 * @package App\Services
 */
class ElibraryHelperService implements ParserHelperInterface
{
    private $elibraryApiService;

    /**
     * ElibraryHelperService constructor.
     * @param ElibraryApiService $jobApiService
     */
    public function __construct(ElibraryApiService $elibraryApiService)
    {
        $this->elibraryApiService = $elibraryApiService;
    }

    public function setData()
    {
        $this->elibraryApiService->getUrlDataAndWriteIntoDatabase();
    }


}
