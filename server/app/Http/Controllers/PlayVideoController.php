<?php

namespace App\Http\Controllers;

use Aws\Exception\AwsException;

use Illuminate\Http\Request;
use Aws\CloudFront\CloudFrontClient;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class PlayVideoController extends Controller
{
    public function show (Request $request)
    {
        $cloudFrontClient = new CloudFrontClient([
            'profile' => 'default',
            'version' => '2014-11-06',
            'region' => 'us-east-1'
        ]);
        $resourceKey = "https://thejiroboy.com/*";
        // 有効期限
        $expires = time() + 60;
        //プライベートキー
        $privateKey = storage_path() . '/app/cloud_fron_private_key.pem';
        $keyPairId = 'APKAI7FUZKWRIPTLWDYA';
        $customPolicy = <<<POLICY
        {
            "Statement": [
                {
                    "Resource": "{$resourceKey}",
                    "Condition": {
                        "DateLessThan": {"AWS:EpochTime": {$expires}}
                    }
                }
            ]
        }
        POLICY;
        $cookies = $this->signCookiePolicy($cloudFrontClient, $customPolicy, $privateKey, $keyPairId);

        $limit = time()+60;
        $path = '/';
        $domain = 'thejiroboy.com';
        $secure = true;
        $httponly = false;
        $cookie_options = ['expires' => $limit  , 'path' => $path, 'httponly' => $httponly, 'domain' => $domain,'samesite' => 'None', 'secure' => $secure];
        setcookie('CloudFront-Policy', $cookies['CloudFront-Policy'], $cookie_options);
        setcookie('CloudFront-Signature', $cookies['CloudFront-Signature'], $cookie_options);
        setcookie('CloudFront-Key-Pair-Id', $cookies['CloudFront-Key-Pair-Id'], $cookie_options);
        echo '<pre>';
            var_dump($cookies['CloudFront-Policy']);
            var_dump($cookies['CloudFront-Signature']);
            var_dump($cookies['CloudFront-Key-Pair-Id']);
        echo '</pre>';
        return view('play_video');
       }
       public function signCookiePolicy($cloudFrontClient, $customPolicy,
           $privateKey, $keyPairId)
       {
           try {
               $result = $cloudFrontClient->getSignedCookie([
                   'policy' => $customPolicy,
                   'private_key' => $privateKey,
                   'key_pair_id' => $keyPairId
               ]);

               return $result;

           } catch (AwsException $e) {
               return [ 'Error' => $e->getAwsErrorMessage() ];
           }
       }
}
