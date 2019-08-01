<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Request\Request;

class FrontController
{
    /**
     * Used for extracting id from uri
     */
    private const EXTRACT_ID_PATTERN = '/(?<id>\d+)/';

    /**
     * Used for extracting uri if id is also present
     */
    private const EXTRACT_URI_PATTERN = '/(?<uri>.*)\//';

    /**
     * Used for removing query string from the uri
     */
    private const REMOVE_QUERY_PATTERN = '/(?<uri>.*)\?/';

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

    /**
     * FrontController constructor.
     * @param array $anonymousRoutesConfiguration
     * @param array $loggedInRoutesConfiguration
     */
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

        if (strpos($uri, '?')) {
            $uri = $this->removeQueryStringFromUri($uri);
        }


        $routesConfiguration = $this->getAvailableRoutes();

        $uriWithoutId = (preg_match(self::EXTRACT_ID_PATTERN, $uri))
            ? $this->getUriWithoutId($uri)
            : $uri;

        if (!$this->isRouteAvailable($uriWithoutId, $routesConfiguration)) {
            header('Location:/user/login');
            return;
        }

        if (true === $routesConfiguration[$uriWithoutId]['arguments']) {
            $id = $this->getIdFromUri($uri);


            if (!$this->isRouteAvailable($uriWithoutId, $routesConfiguration)) {
                return;
            }

            $className = $routesConfiguration[$uriWithoutId]['className'];
            $methodName = $routesConfiguration[$uriWithoutId]['methodName'];

            $controller = new $className($this->request);
            $controller->$methodName($id);

            return;
        }


        $className = $routesConfiguration[$uri]['className'];
        $methodName = $routesConfiguration[$uri]['methodName'];

        $controller = new $className($this->request);
        $controller->$methodName();


    }

    /**
     * @param string $uri Contains uri as given in server superglobal
     * @return string Contains uri without query string
     */
    private function removeQueryStringFromUri(string $uri): string
    {
        preg_match(self::REMOVE_QUERY_PATTERN, $uri, $matches);

        return $matches['uri'];
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

    /**
     * @param string $uri
     * @return string
     */
    private function getUriWithoutId(string $uri): string
    {
        preg_match(self::EXTRACT_URI_PATTERN, $uri, $matches);

        return $matches['uri'];
    }

    /**
     * @param string $route
     * @param array $routesConfiguration
     * @return bool
     */
    public function isRouteAvailable(string $route, array $routesConfiguration): bool
    {
        return array_key_exists($route, $routesConfiguration);

    }

    /**
     * @param string $uri
     * @return int
     */
    private function getIdFromUri(string $uri): int
    {
        preg_match(self::EXTRACT_ID_PATTERN, $uri, $matches);

        return (int)$matches['id'];
    }


}