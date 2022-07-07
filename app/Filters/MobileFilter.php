<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MobileFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // get the current URL path, like "auth/login"
        $currentURIPath = "/{$request->uri->getPath()}";

        // check if the current path is auth path, just return true
        // don't forget to use named routes to simplify the call
        if (in_array($currentURIPath, [route_to('pc-detected')])) {
            return;
        }

        if (!preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
        |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        )) {
            return redirect('pc-detected');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
