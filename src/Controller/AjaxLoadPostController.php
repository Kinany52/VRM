<?php

namespace App\Controller;

use App\Controller\LoadPostController;
use PDOException;

Class AjaxLoadPostController
{
    /**
     * @return void 
     * @throws PDOException 
     */
    public function loadPostAjax(): void
    {
        $limit = 10; //Number of posts to be loaded per call
        $posts = new LoadPostController();
        $posts->loadPost($_REQUEST, $limit);
    }
}