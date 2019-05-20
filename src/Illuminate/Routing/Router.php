<?php

namespace Dingo\Api\Illuminate\Routing;

use Illuminate\Http\Request;
use Illuminate\Routing\Router as IlluminateRouter;
use Illuminate\Routing\Route as IlluminateRoute;

class Router extends IlluminateRouter
{
    use Helper;

    /**
     * Run the given route within a Stack "onion" instance.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function runRouteWithinStack(IlluminateRoute $route, Request $request)
    {
        return parent::runRouteWithinStack(Route::clone($route), $request);
    }
}
