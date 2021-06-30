<?php
namespace Payment\Service;

use Symfony\Component\HttpClient\HttpClient;
use Payment\Entity\Currency\Currency;
use Payment\Repository\CurrencyRepository;

class CurrencyService {
   
    // access key should be loaded from configuration
    private static $accessKey = '8a2166a08619e96c7a47b664df83a9fa';

    /**
     *
     * @param [type] $currencies
     * @param boolean $test
     * @return void
     */
    public static function init($currencies, $test =false) {
        if ($test) {
            self::initTestCurrency($currencies);
        }
        else {
            self::initCurrency($currencies);
        }
    }

    private static function initCurrency($currencies) {

        $currencyList = implode(',', array_merge(['EUR', 'USD'], array_keys($currencies)));

        $client = HttpClient::create();
        
        // separate service should be created
        $url = sprintf('http://api.exchangeratesapi.io/live?access_key=%s&currencies=%s', self::$accessKey, $currencyList);
        
        $response = $client->request('GET', $url);
        if ($response->getStatusCode()!=200) {
            throw new \Exception('Retrieve currency rate error');
        }

        $content = json_decode($response->getContent(), true);

        // because base currency is USD in free subscription
        // we need to convert into base currency EUR
        // eur_rate = usd_rate * (1 / eur_usd_rate)
        $baseRate = 1/$content['quotes']["USDEUR"];

        foreach ($currencies as $name => $curr) {
            $rate = $baseRate * $content['quotes']["USD${name}"];
            $currency = new Currency($name, $rate, $curr['scale'], $curr['ceil']);
            CurrencyRepository::add($currency);
        } 
    }

    /**
     *
     * @return void
     */
    private static function initTestCurrency($currencies) {
        foreach ($currencies as $name => $curr) {
            $currency = new Currency($name, $curr['rate'], $curr['scale'], $curr['ceil']);
            CurrencyRepository::add($currency);
        } 
    }
}