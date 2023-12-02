<?php

namespace Hxsoul\TeraboxDownload;
use hxsoul\TeraboxDownload\constants;

use Exception;

class getTokenGenerator
{
    public function getTokens($link)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL            => $link,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
                CURLOPT_HTTPHEADER     => array(
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                    'Accept-Language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,hi;q=0.6',
                    'Connection: keep-alive',
                    'Cookie: csrfToken=x0h2WkCSJZZ_ncegDtpABKzt; browserid=Bx3OwxDFKx7eOi8np2AQo2HhlYs5Ww9S8GDf6Bg0q8MTw7cl_3hv7LEcgzk=; lang=en; TSID=pdZVCjBvomsN0LnvT407VJiaJZlfHlVy; __bid_n=187fc5b9ec480cfe574207; ndus=Y-ZNVKxteHuixZLS-xPAQRmqh5zukWbTHVjen34w; __stripe_mid=895ddb1a-fe7d-43fa-a124-406268fe0d0c36e2ae; ndut_fmt=FF870BBFA15F9038B3A39F5DDDF1188864768A8E63DC6AEC54785FCD371BB182; TSID=S5X11OKXnDBuZm5xJt9aSmhrYMR6Q6TK; browserid=hHX3KRuSjKqpXvoo2iGWaPfY4NLfWxWcECkz9kJ-1a4z_UO99KgQ1xGzSDc=; csrfToken=6-9YFHlNySss5HKL_bMoVVjP; lang=en',
                    'DNT: 1',
                    'Host: www.4funbox.com',
                    'Sec-Fetch-Dest: document',
                    'Sec-Fetch-Mode: navigate',
                    'Sec-Fetch-Site: none',
                    'Sec-Fetch-User: ?1',
                    'Upgrade-Insecure-Requests: 1',
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36',
                    'sec-ch-ua: \\"Google Chrome\\";v=\\"113\\", \\"Chromium\\";v=\\"113\\", \\"Not-A.Brand\\";v=\\"24\\"',
                    'sec-ch-ua-mobile: ?0',
                    'sec-ch-ua-platform: \\"Windows\\"'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            if ($response === false) {
                echo constants::curlError;
            }

            $jsToken = self::findBetween($response, "fn%28%22", "%22%29");
            $logId   = self::findBetween($response, "dp-logid=", "&");

            if (!$jsToken && !$logId) {
                return ['jsToken' => $jsToken, 'logId' => $logId];
            } else {
                return constants::tokenError;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function findBetween($str, $start, $end)
    {
        $startIndex = strpos($str, $start) + strlen($start);
        $endIndex = strpos($str, $end, $startIndex);
        return substr($str, $startIndex, $endIndex - $startIndex);
    }
}