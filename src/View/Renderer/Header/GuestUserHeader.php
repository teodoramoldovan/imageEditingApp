<?php


namespace ShareMyArt\View\Renderer\Header;


use ShareMyArt\Model\Helper\HeaderOptionsConstants;

class GuestUserHeader extends HeaderDecorator
{


    public function __construct(AbstractHeader $headerList)
    {
        $this->headerList = $headerList;
    }

    public function getHeaderList(): array
    {
        $anonymousDropdownOptions=HeaderOptionsConstants::getAnonymousOptions();
        return array_merge(
            $anonymousDropdownOptions,
            $this->headerList->getHeaderList()
        );
    }

}