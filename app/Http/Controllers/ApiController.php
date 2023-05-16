<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    public function getMethod() {
        if (request('method') == 'rates') {
            $result = $this->rates();
        } else {
            $result = response([
                "status" =>  "error",
                "code" =>  400,
                "message" => "method not found"
            ], 400);
        }

        if (request()->isMethod('post')) {
            if (request('method') == 'convert') {
                $result = $this->convert();
            }  else {
                $result = response([
                    "status" =>  "error",
                    "code" =>  400,
                    "message" => "method not found"
                ], 400);
            }
        }
        return $result;
    }

    public function rates() {
        
        $rates = Http::get('https://blockchain.info/ticker')->json();
        $data = [];
        
        if (request('parameter')) {
            $data[request('parameter')] = round($rates[request('parameter')]['last'] * 1.02, 2);
        } else {
            foreach ($rates as $key => $val) {
                // $data[$key.'_base'] = $val['last'];
                $data[$key] = round($val['last']  * 1.02, 2);
            }
            asort($data);
        }

        $result = response([
            "status" => "success",
            "code" =>  200,
            "data" => $data
        ], 200);
    
        return $result;
    }

    public function convert() {
        
        $data = [];
        $error = 0;
        if (request()->post('currency_from') && request()->post('currency_to') && request()->post('value') && is_numeric(request()->post('value'))){
            $codeFrom = request()->post('currency_from');
            $codeTo = request()->post('currency_to');
            $valueFrom = round(request()->post('value'), 2);
            
            $rates = Http::get('https://blockchain.info/ticker')->json();
            
            if ($codeFrom != $codeTo) {
                if ($codeFrom == 'BTC') {
                    $rate = $rates[$codeTo]['last'];
                    $valueTo = round($valueFrom * $rate * 1.02, 2);
                } elseif ($codeTo == 'BTC') {
                    $rate = $rates[$codeFrom]['last'];
                    $valueTo = round(($valueFrom / $rate) * 1.02, 10);
                } else {
                    $error = 1;
                    $rate = 0;
                }
                $rate = round($rate * 1.02, 2);
            } else {
                $rate = 1;
                $valueTo = 1;
            }
        } else {
            $error = 1;
        }

        if (!$error) {
            $data = [
                'currency_from' => $codeFrom,
                'currency_to' => $codeTo,
                'value' => $valueFrom,
                'converted_value' => $valueTo,
                'rate' => $rate
            ];
    
            $result = response([
                "status" => "success",
                "code" => 200,
                "data" => $data
            ], 200);
        } else {
            $result = response([
                "status" =>  "error",
                "code" =>  400,
                "message" => "Bad request"
            ], 400);
        }

        return $result;
    }
}
