<?php

namespace App\Http\Controllers;

require_once(base_path().'/currencies/helpers/Currencies.php');
require_once(base_path().'/currencies/helpers/CurrencyConverter.php');

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ConvertCurrencyRequest;
use Currencies\Helpers\CurrencyConverter;
use Currencies\Helpers\Currencies;

class CurrencyRateController extends Controller
{
    const STATUS_OK = 200;
    const STATUS_ERROR = 400;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $currencies = new Currencies();
        $converter = new CurrencyConverter($currencies);
        $valuteProps = $converter->getValuteProps();

        return view('converter.index', compact('valuteProps'));
    }

    /**
     * Обрабатывает ajax-запрс, возвращает полученную на вход сумму, конвертированную в другую валюту
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert(ConvertCurrencyRequest $request)
    {
        $price = (int)$request->price;
        $from = (string)$request->from;
        $to = (string)$request->to;

        $currencies = new Currencies();
        $converter = new CurrencyConverter($currencies);
        $priceConverted = $converter->getConvertedPrice(
            $price,
            $currencies->getCurrencyById($from),
            $currencies->getCurrencyById($to)
        );
        return response()->json([
            'status' => self::STATUS_OK,
            'result' => $priceConverted,
        ], self::STATUS_OK);
    }
}
