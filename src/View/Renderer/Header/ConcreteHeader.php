<?php


namespace ShareMyArt\View\Renderer\Header;


class ConcreteHeader extends AbstractHeader
{
    /**
     * Will initialize the list with option as an empty array
     * that will be constructed later
     *
     * ConcreteHeader constructor.
     */
    public function __construct()
    {
        $this->headerList = [];
    }

    public function getHeaderList(): array
    {
        return $this->headerList;
    }
}