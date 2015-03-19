<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function helloAction(Request $request)
    {
        return new Response(sprintf('Hello, %s', $request->get('name') ?: 'World'), 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
