<?php


namespace ShareMyArt\Controller;


class FrontController
{
    private $routesConfiguration;

    public function __construct(array $routesConfiguration)
    {
        $this->routesConfiguration = $routesConfiguration;
    }

    /**
     * Will search in the routes configuration and will dispatch the
     * corresponding controller for the given url
     *
     * @param string $uri
     */
    public function dispatch(string $uri): void
    {
        $className = $this->routesConfiguration[$uri]['className'];
        $methodName = $this->routesConfiguration[$uri]['methodName'];

        $controller = new $className();
        $controller->$methodName();
    }


}