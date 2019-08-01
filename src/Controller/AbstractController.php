<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Request\Request;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}