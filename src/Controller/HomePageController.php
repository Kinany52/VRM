<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use App\Controller\SubmitPostController;
use Core\Http\Header;
use Core\Http\Response;
use Core\Template;
use Exception;

class HomepageController
{
    /**
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        if (isset($_SESSION['username'])) {
            $userLoggedIn = $_SESSION['username'];
            $user = UsersRepository::queryUser($userLoggedIn);
        } else {
            return (new Response(302))->addHeader(
                new Header(
                    name: 'Location', value: '/auth'
                )
            );
        }
        if (isset($_POST['post'])) {
            $post = new SubmitPostController();
            $post->submitPost($_POST['post_text']);
            return (new Response(302))->addHeader(
                new Header(
                    name: 'Location', value: '/'
                )
            );
            //header("Location: /"); //Stops the form resubmitting on refresh (duplicate announcement prevention).
        }
        $template = new Template(__DIR__ . '/../View');
        return (new Response(
            content: $template->render('HomepageView.php', ['user' => $user])
        ))->addHeader(
            new Header(
                'Content-Type',
                'text/html; charset=UTF-8',
            )
        );
    }
}