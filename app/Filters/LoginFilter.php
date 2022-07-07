<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // get the current URL path, like "auth/login"
        $currentURIPath = "/{$request->uri->getPath()}";

        // check if the current path is auth path, just return true
        // don't forget to use named routes to simplify the call
        if (in_array($currentURIPath, [route_to('login'), route_to('logout'), route_to('daftar'), route_to('pc-detected')])) {
            return;
        }

        // Do something here
        if (!session()->has('_ci_user_login')) {
            return redirect()->to('login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
