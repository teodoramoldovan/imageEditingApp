<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Request\Request;

class FrontController
{
    /**
     * @var array
     */
    private $anonymousRoutesConfiguration;

    /**
     * @var array
     */
    private $loggedInRoutesConfiguration;

    /**
     * @var Request
     */
    private $request;

    public function __construct(array $anonymousRoutesConfiguration,
                                array $loggedInRoutesConfiguration)
    {
        $this->anonymousRoutesConfiguration = $anonymousRoutesConfiguration;
        $this->loggedInRoutesConfiguration = $loggedInRoutesConfiguration;
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
        $routesConfiguration = $this->getAvailableRoutes();
        if (!$this->isRouteAvailable($uri,$routesConfiguration)) {
            return;
        }

        $className = $routesConfiguration[$uri]['className'];
        $methodName = $routesConfiguration[$uri]['methodName'];

        $controller = new $className($this->request);
        $controller->$methodName();
    }

    /**
     * Will allow access to certain routes if the user is
     * logged in or not
     *
     * @return array
     */
    public function getAvailableRoutes(): array
    {
        $sessionData = $this->request->getSessionData(null);
        if (array_key_exists('userId', $sessionData)) {
            return array_merge($this->anonymousRoutesConfiguration,$this->loggedInRoutesConfiguration);
        }

        return $this->anonymousRoutesConfiguration;

    }

    public function isRouteAvailable(string $route, array $routesConfiguration):bool
    {
        if(!array_key_exists($route,$routesConfiguration)){

            require_once "src/View/Template/HttpErrorTemplate/error401.php";
            http_response_code(401);
            return false;
        }

        return true;
    }


}