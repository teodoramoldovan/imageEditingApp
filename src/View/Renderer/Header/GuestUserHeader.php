<?php


namespace ShareMyArt\View\Renderer\Header;


class GuestUserHeader extends HeaderDecorator
{
    /**
     * options available when the user is browsing the website anonymously
     */
    const anonymousListOptions = ['/user/login' => 'Login'];

    public function __construct(AbstractHeader $headerList)
    {
        $this->headerList = $headerList;
    }

    public function getHeaderList(): array
    {
        return array_merge(
            self::anonymousListOptions,
            $this->headerList->getHeaderList()
        );
    }

}