<?php


namespace ShareMyArt\View\Renderer\Header;


use ShareMyArt\Helper\HeaderOptionsConstants;
use ShareMyArt\View\Renderer\LoginPageRenderer;

class LoggedInUserHeader extends HeaderDecorator
{


    public function __construct(AbstractHeader $headerList)
    {
        $this->headerList = $headerList;
    }

    public function getHeaderList(): array
    {
        $loggedInDropdownOptions=HeaderOptionsConstants::getLoggedInOptions();
        return array_merge(
            $loggedInDropdownOptions,
            $this->headerList->getHeaderList()
        );
    }
}