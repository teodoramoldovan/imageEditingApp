<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Request\Request;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}