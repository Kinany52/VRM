<?php

namespace App\Controller;

use App\Controller\LoadPostController;
use Core\Http\Response;
use PDOException;

Class AjaxLoadPostController
{
    /**
     * @return Response 
     * @throws PDOException 
     */
    public function loadPostAjax(): Response
    {
        $limit = 10; //Number of posts to be loaded per call
        $posts = new LoadPostController();
        $posts->loadPost($_REQUEST, $limit);
        return new Response();
    }
}