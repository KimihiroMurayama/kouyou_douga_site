<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopPageController extends Controller
{
    public function index() {
        return view('top_page')->with(
            [
                'recommended_movie_ids' => $this->getRecommendedMovieId()
            ]
        );
    }
    private function getRecommendedMovieId(){
        return [1,2];
    }
}
