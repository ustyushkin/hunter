<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 9:22 PM
 */

//token: 94fc21c4d2745ec6442a6d90093e8e6c0653b3b1

namespace system;

class PrivatBankApi
{
    protected $url = PRIVAT_BANK_API_URL;
    protected $timeout = 1000;

    public function getData()
    {
        $result = [];
        $response = $this->request();
        $prepareCurrency = json_decode($response, true);
        foreach ($prepareCurrency as $item) {
            $result[$item['ccy']] = $item;
        }
        return $result;
    }

    protected function request()
    {
        try {
            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            if (!$response) {
                throw new Exception('Response is null');
            }
            return $response;
        } catch (Exception $e) {
            echo "trabl:" . $e->getMessage();
        }
    }
}