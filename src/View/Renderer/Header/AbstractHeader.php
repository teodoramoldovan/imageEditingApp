<?php


namespace ShareMyArt\View\Renderer\Header;


abstract class AbstractHeader
{
    /** @var array $headerList list of options available in the dropdown menu */
    protected $headerList;

    abstract public function getHeaderList(): array;

}