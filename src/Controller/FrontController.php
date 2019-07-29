<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Request\Request;

class FrontController
{
    /**
     * @var array
     */
    private $routesConfiguration;

    /**
     * @var Request
     */
    private $request;

    public function __construct(array $routesConfiguration)
    {
        $this->routesConfiguration = $routesConfiguration;
        $this->request = new Request();
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

        $controller = new $className($this->request);
        $controller->$methodName();
    }


}