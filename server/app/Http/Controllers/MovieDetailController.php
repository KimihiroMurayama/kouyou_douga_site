<?php

namespace App\Http\Controllers;

use Aws\Exception\AwsException;

use Illuminate\Http\Request;
use Aws\CloudFront\CloudFrontClient;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class MovieDetailController extends Controller
{
    public function index ($movieId) {
        return view('movie_detail')->with(
            [
                "movie_url" => $this->createUrl($movieId)
            ]
        );
    }
    private function createUrl ($movieId){
        return "https://thejiroboy.com/${movieId}_hts.m3u8";
    }
}
