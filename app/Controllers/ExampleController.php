<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class ExampleController
{

    public function index()
    {
        $posts= App::get('database')-> selectPostsWithUser(0, 6);
        $classificacoes = App::get('database')->selectAll('classificacoes');
        foreach ($posts as $post) {
            $post->classificacoes = App::get('database')->selectPostsWithClassification($post->id);
        }
        return view('site/landingpage',compact('posts','classificacoes'));

}

}