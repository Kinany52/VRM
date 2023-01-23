<?php

namespace App\Controller;

use Core\Http\Header;
use Core\Http\Response;

Class LogoutController
{
    /** @return void  */
    public function logout(): Response
    {
        session_destroy();
        return (new Response(302))->addHeader(
            new Header(
                name: 'Location', value: '/auth'
            )
        );
    }
}