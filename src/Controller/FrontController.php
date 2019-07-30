<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Request\Request;

class FrontController
{
    private const EXTRACT_ID_PATTERN = '/(?<id>\d+)/';
    private const EXTRACT_URI_PATTERN = '/(?<uri>.*)\//';
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
        if (preg_match(self::EXTRACT_ID_PATTERN, $uri)) {
            $uriWithoutId = $this->getUriWithoutId($uri);
        } else {
            $uriWithoutId = $uri;
        };

        if (true === $routesConfiguration[$uriWithoutId]['arguments']) {
            $id = $this->getIdFromUri($uri);


            if (!$this->isRouteAvailable($uriWithoutId, $routesConfiguration)) {
                return;
            }

            $className = $routesConfiguration[$uriWithoutId]['className'];
            $methodName = $routesConfiguration[$uriWithoutId]['methodName'];

            $controller = new $className($this->request);
            $controller->$methodName($id);

        } else {
            if (!$this->isRouteAvailable($uri, $routesConfiguration)) {
                return;
            }

            $className = $routesConfiguration[$uri]['className'];
            $methodName = $routesConfiguration[$uri]['methodName'];

            $controller = new $className($this->request);
            $controller->$methodName();
        };

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
            return array_merge($this->anonymousRoutesConfiguration, $this->loggedInRoutesConfiguration);
        }

        return $this->anonymousRoutesConfiguration;

    }

    private function getIdFromUri(string $uri): int
    {
        preg_match(self::EXTRACT_ID_PATTERN, $uri, $matches);

        return (int)$matches['id'];
    }

    private function getUriWithoutId(string $uri): string
    {
        preg_match(self::EXTRACT_URI_PATTERN, $uri, $matches);

        return $matches['uri'];
    }

    public function isRouteAvailable(string $route, array $routesConfiguration): bool
    {
        if (!array_key_exists($route, $routesConfiguration)) {

            require_once "src/View/Template/HttpErrorTemplate/error401.php";
            http_response_code(401);
            return false;
        }

        return true;
    }


}