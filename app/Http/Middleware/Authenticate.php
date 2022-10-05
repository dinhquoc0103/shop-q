<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {   
        // $request->expectsJson() nếu true thì đã đi các route nằm trong middleware auth  và false thì ngược lại
        if (!$request->expectsJson()) 
        {
            $currentUrl = url()->full();
            $tempArray = explode('/', $currentUrl);
            $route = in_array("admin", $tempArray) ? "admin.login.page" : "login.page";

            return route($route);    
        }
    }

}
