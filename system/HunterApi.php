<?php
/**
 * Created by IntelliJ IDEA.
 * User: yustas
 * Date: 2/26/20
 * Time: 9:22 PM
 */

//token: 94fc21c4d2745ec6442a6d90093e8e6c0653b3b1

namespace system;

class HunterApi
{
    protected $token = HUNTER_API_TOKEN;
    protected $url = HUNTER_API_URL;
    protected $timeout = 1000;
    protected $currentPage = 1;

    public function getData()
    {
        $response = $this->request();
        return json_decode($response, true);
    }

    public function getFirstPage()
    {
        $this->currentPage = 1;
        return $this->getData();
    }

    public function getNextPage()
    {
        $this->currentPage++;
        return $this->getData();
    }

    protected function request()
    {
        $this->addHead = [
            "Authorization: Bearer " . $this->token,
            "accept: */*",
            "Connection: keep-alive",
            "Host: api.freelancehunt.com",
            "Sec-Fetch-Mode: cors",
        ];
        try {
            //filter[skill_id]=1,86,99&
            $ch = curl_init($this->url . 'projects/?page[number]=' . $this->currentPage);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->addHead);
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