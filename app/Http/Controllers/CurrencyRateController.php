<?php

namespace App\Http\Controllers;

use CentralBankRussian\ExchangeRate\CBRClient;
use CentralBankRussian\ExchangeRate\Exceptions\ExceptionIncorrectData;
use CentralBankRussian\ExchangeRate\Exceptions\ExceptionInvalidParameter;
use CentralBankRussian\ExchangeRate\ExchangeRate;
use DateTime;
use Illuminate\Http\Request;

class CurrencyRateController extends Controller
{
    public function index()
    {
        $this->getRates();
    }

    private function getRates()
    {
        /*$exchangeRate = new ExchangeRate(
            new CBRClient()
        );

        try {

            $rateInRubles = $exchangeRate
                ->setDate(new DateTime('now'))
                ->getRateInRubles('AMD');

            dd($rateInRubles);

        } catch (ExceptionIncorrectData | ExceptionInvalidParameter $e) {
            echo $e->getMessage();
        }*/
    }
}
