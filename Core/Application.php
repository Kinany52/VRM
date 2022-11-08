<?php

namespace Core;

use Core\Router;

class Application 
{
    public function __construct(protected Router $router) 
    {
        $this->registerRoutes();
    }

    public function handleRequest(array $request): void 
    {
        $this->router->dispatch($request['QUERY_STRING']);
    }

    private function registerRoutes(): void
    {
        $this->router->add('', ['controller' => 'HomepageController', 'action' => 'index']);
        $this->router->add('auth', ['controller' => 'AuthenticationController', 'action' => 'authenticate']);
        $this->router->add('profile', ['controller' => 'ProfileController', 'action' => 'index']);
        $this->router->add('user_closed', ['controller' => 'UserClosedController', 'action' => 'index']);
        $this->router->add('delete_post', ['controller' => 'DeletePostController', 'action' => 'postDelete']);
        $this->router->add('ajax_load', ['controller' => 'AjaxLoadPostController', 'action' => 'loadPostAjax']);
        $this->router->add('confirm_post', ['controller' => 'ConfirmPostController', 'action' => 'confirmPost']);
        $this->router->add('comment_frame', ['controller' => 'CommentController', 'action' => 'frameComment']);
        $this->router->add('load_post', ['controller' => 'LoadPostController', 'action' => 'loadPost']);
        $this->router->add('submit_post', ['controller' => 'SubmitPostController', 'action' => 'submitPost']);
        $this->router->add('logged_out', ['controller' => 'LogoutController', 'action' => 'logout']);
        $this->router->add('{controller}/{action}');
        $this->router->add('{controller}/{id:\d+}/{action}');
    }
}