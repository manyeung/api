<?php

namespace Dingo\Api\Illuminate\Routing;

use Illuminate\Routing\Route as IlluminateRoute;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use Dingo\Api\Http\Response;

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
        $response = parent::run();

        if ($response instanceof JsonResponse) {
            return $response;
        }

        if (is_string($response) || is_numeric($response) || is_bool($response)) {
            return new JsonResponse($response);
        }

        if (is_null($response)) {
            return new JsonResponse(['data' => null]);
        }

        $factory = app('api.transformer');
        $binding = null;

        if ($factory->transformableResponse($response)) {
            $class = $response;

            if ($this->isCollection($response)) {
                $class = $response->first();
            }

            $class = get_class($class);
            $binding = $factory->getTransformerBindings()[$class];
        }

        return new Response($response, 200, [], $binding);
    }

    protected function isCollection($instance)
    {
        return $instance instanceof Collection || $instance instanceof Paginator;
    }
}
