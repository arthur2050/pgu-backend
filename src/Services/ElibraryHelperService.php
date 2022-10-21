<?php


namespace App\Services;

/**
 * Class ElibraryHelperService
 * @package App\Services
 */
class ElibraryHelperService
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