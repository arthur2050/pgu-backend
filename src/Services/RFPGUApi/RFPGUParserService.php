<?php


namespace App\Services\RFPGUApi;


use DOMDocument;
use DOMXPath;

class RFPGUParserService implements ParserInterface
{

    /**
     * @var ApiRequestInterface $guzzleApiRequest
     */
    private $guzzleApiRequestService;

    /**
     * RFPGUParserService constructor.
     *
     * @param ApiRequestInterface $guzzleApiRequestService
     */
    public function __construct(ApiRequestInterface $guzzleApiRequestService)
    {
        $this->guzzleApiRequestService = $guzzleApiRequestService;
    }


    public function getUrlData($url = '/', $method = 'GET', $options =[])
    {
        $urlData = $this->guzzleApiRequestService->sendApiRequest($url, $method, $options);

        $htmlString = $urlData->getBody()->getContents();
        //add this line to suppress any warnings
        libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);
        $xpathPublications = $xpath->evaluate('//div[@class="cpage_body"]');
//        dump($xpathPublications);
        $text = $xpathPublications[0]->textContent;

        if(preg_match('/(Публикац.{1}.{1}|[нН]аучн.{1}.{1}\s*(труд|раб)).+(<br>{1,3}|\s*[абв]?\s*)\)\s*(учеб)|(Публикац.{1}.{1}).*/ui', $text,$matches)){
            $text = $matches[0];
            $textBegin = substr($text, 0,80);
            $textBegin = preg_replace('/(Публикац.{1}.{1}|[нН]аучн.{1}.{1}\s*(труд|раб{1,3}))/i','', $textBegin);
            $textEnd = substr($text, -1,80);
            $textEnd = preg_replace('/(<br>{1,3}|\s*[абв]?\s*)\)\s*(учеб)/i','', $textEnd);
            $text = substr_replace($text, $textBegin, 0, 80);
            $text = substr_replace($text, $textEnd, -1, 80);
          return  $text; // 0 is the most relevant
        } //if the expression is satisfied with us result the do something logic

        return false;
    }

}
