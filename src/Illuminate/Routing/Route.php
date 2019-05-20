<?php

namespace Dingo\Api\Illuminate\Routing;

use Illuminate\Routing\Route as IlluminateRoute;

class Route extends IlluminateRoute
{
    use Helper;

    /**
     * Run the route action and return the response.
     *
     * @return mixed
     */
    public function run()
    {
        return app('api.transformer')->transform(parent::run());
    }
}
