<?php

namespace Hxsoul\TeraboxDownload;

use Exception;

class getShortUrlGenerator
{
    public function getShortUrl($url)
    {
        try {
            $headers = get_headers($url, 1);
            $href = $headers['Location'];
            $parsed_url = parse_url($headers['Location']);
            parse_str($parsed_url['query'], $query_params);
            $shortUrl = $query_params['surl'];
            return ['link' => $href, 'shortUrl' => $shortUrl];
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}