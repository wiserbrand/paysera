<?php
namespace Payment\Service;

use Symfony\Component\HttpClient\HttpClient;
use Payment\Entity\Currency\Currency;
use Payment\Repository\CurrencyRepository;

class CurrencyService {
    
    private static $accessKey = '8a2166a08619e96c7a47b664df83a9fa';
    private static $supportedCurrency = [
        'EUR' => ['rate' => 1, 'scale' => 2, 'ceil' => false],
        'USD' => ['rate' => 1.1497, 'scale' => 2, 'ceil' => false],
        'JPY' => ['rate' => 129.53, 'scale' => 0, 'ceil' => true],
    ];


    public static function init($test =false) {
        if ($test) {
            self::initTestCurrency();
        }
        else {
            self::initCurrency();
        }
    }

    public static function initCurrency() {

        $currencies = implode(',', array_merge(['EUR', 'USD'], array_keys(self::$supportedCurrency)));

        $client = HttpClient::create();
        $url = sprintf('http://api.exchangeratesapi.io/live?access_key=%s&currencies=%s', self::$accessKey, $currencies);
        
        $response = $client->request('GET', $url);
        if ($response->getStatusCode()!=200) {
            throw new \Exception('Retrieve currency rate error');
        }

        $content = json_decode($response->getContent(), true);

        // because base currency is USD in free subscription
        // we need to convert into base currency EUR
        // eur_rate = usd_rate * (1 / eur_usd_rate)
        $baseRate = 1/$content['quotes']["USDEUR"];

        foreach (self::$supportedCurrency as $name => $curr) {
            $rate = $baseRate * $content['quotes']["USD${name}"];
            $currency = new Currency($name, $rate, $curr['scale'], $curr['ceil']);
            CurrencyRepository::add($currency);
        } 
    }

    /**
     *
     * @return void
     */
    private static function initTestCurrency() {
        foreach (self::$supportedCurrency as $name => $curr) {
            $currency = new Currency($name, $curr['rate'], $curr['scale'], $curr['ceil']);
            CurrencyRepository::add($currency);
        } 
    }
}