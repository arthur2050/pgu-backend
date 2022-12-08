<?php


namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class GuzzleHelperService
 * @package App\Services
 */
class GuzzleHelperService implements ApiRequestInterface
{
    private $client;

    private $isAuthorized;

    private $cookie;
    /**
     * GuzzleHelperService constructor.
     * @param string $baseUrlRequest
     */
    public function __construct(
        string $baseUrlRequest,
        bool $authorize = false
    )
    {
        $config = ['base_uri' => $baseUrlRequest];
        if($authorize) { //если клиенту необходимо авторизация то предусматриваем это
            array_push($config, ['verify'  => false,                        // если сайт использует SSL, откючаем для предотвращения ошибок
            'allow_redirects' => false,            // разрешаем редиректы
            'headers' => [                         // устанавливаем различные заголовки
                'user-agent'   => 'Mozilla/5.0 (Linux 3.4; rv:64.0) Gecko/20100101 Firefox/15.0',
                'accept'       => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'content-Type' => 'application/x-www-form-urlencoded' // кодирование данных формы, в такой кодировке            браузер отсылает данные на сервер
            ]]);
        }
        $this->client = new Client($config);
    }

    /**
     * @param string $url
     * @param string $method
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendApiRequest(string $url = '', string $method = 'GET', $options = [])
    {
        $options = [];
//        if($this->isAuthorized) {
//            array_push($options,['headers' => [
//                'Cookie' => $this->cookie
//            ]]);
//        }
        return $this->client->request($method, $url, $options);
    }

    public function authorize(string $urlAuth, array $authData) //возвращаем печеньки чтобы потом делать запрос
    {
        if($this->isAuthorized) throw new \HttpException("User is Authorized in: {$this->client->getConfig()['base_uri']} "); //если пользователь уже авторизован
        /**
         * В метод request передается три параметра:
         *
         *
         * 1. Методы GET, POST
         * 2. URL на который отправляются данные формы
         * 3. forms_params - значения логина и пароля
         */
//        $this->initialize();
        $baseUrl = (string)$this->client->getConfig('base_uri');
//        $baseUrl = "{$baseUrl['scheme']}//{$baseUrl['host']}{$baseUrl['path']}";
        $login = $this->sendApiRequest($urlAuth, 'POST', [
            'form_params' => [
                'rpage'    => $baseUrl.'defaultx.asp',
                'login'    => $authData['login'],
                'password' => $authData['password']
            ]
        ]);

        print($login->getStatusCode());                   // статус код, если 200 или 302, то все норм, хотя не всегда)))

        $this->isAuthorized = true;
    }

//    public function initialize()
//    {
//        $data = $this->sendApiRequest((string)$this->client->getConfig('base_uri'));
//        $data = $data->getHeaders();
//        $this->cookie = $data->getHeaderLine('cookie'); // обязательно вытаскиваем cookies из запроса, без них ничего не сработает
//    }
}