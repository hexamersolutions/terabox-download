<?php

namespace Hxsoul\TeraboxDownload;
use Hxsoul\TeraboxDownload\constants;
use Hxsoul\TeraboxDownload\getShortUrlGenerator;
use Hxsoul\TeraboxDownload\getTokenGenerator;

use Exception;

class index{

    public function getLink($url){
        $tokens = (new getTokenGenerator)->getTokens($url);
        $urls = (new getShortUrlGenerator)->getShortUrl($url);

        try {
            $curl = curl_init();
            $url = 'https://www.4funbox.com/share/list';
            $params = array(
                'app_id' => '250528',
                'channel' => 'dubox',
                'clienttype' => '0',
                'desc' => '1',
                'dplogid' => $tokens['logId'],
                'jsToken' => $tokens['jsToken'],
                'num' => '20',
                'order' => 'time',
                'page' => '1',
                'root' => '1',
                'shorturl' => $urls['shortUrl'],
                'site_referer' => $urls['link'],
                'web' => '1',
            );

            // Convert parameters to query string
            $queryString = http_build_query($params);
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url . '?' . $queryString,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                    'Accept-Language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,hi;q=0.6',
                    'Connection: keep-alive',
                    'Cookie: csrfToken=x0h2WkCSJZZ_ncegDtpABKzt; browserid=Bx3OwxDFKx7eOi8np2AQo2HhlYs5Ww9S8GDf6Bg0q8MTw7cl_3hv7LEcgzk=; lang=en; TSID=pdZVCjBvomsN0LnvT407VJiaJZlfHlVy; __bid_n=187fc5b9ec480cfe574207; ndus=Y-ZNVKxteHuixZLS-xPAQRmqh5zukWbTHVjen34w; __stripe_mid=895ddb1a-fe7d-43fa-a124-406268fe0d0c36e2ae; ndut_fmt=FF870BBFA15F9038B3A39F5DDDF1188864768A8E63DC6AEC54785FCD371BB182',
                    'DNT: 1',
                    'Host: www.4funbox.com',
                    'Sec-Fetch-Dest: document',
                    'Sec-Fetch-Mode: navigate',
                    'Sec-Fetch-Site: none',
                    'Sec-Fetch-User: ?1',
                    'Upgrade-Insecure-Requests: 1',
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36',
                    'sec-ch-ua: "Google Chrome";v="113", "Chromium";v="113", "Not-A.Brand";v="24"',
                    'sec-ch-ua-mobile: ?0',
                    'sec-ch-ua-platform: "Windows"'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            // Decode the JSON response
            $data = json_decode($response, true);
            return $data['list'][0]['dlink'];
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
}