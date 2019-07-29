<?php


namespace ShareMyArt\View\Renderer\Header;


use ShareMyArt\View\Renderer\LoginPageRenderer;

class LoggedInUserHeader extends HeaderDecorator
{
    /**
     * options available when the user is logged in
     */
    const loggedInListOptions = ['/user/myUploads' => 'My Uploads',
                                '/user/myOrders' => 'My Orders',
                                '/product/upload' => 'Upload a photo',
                                '/user/logout' => 'Logout'];

    public function __construct(AbstractHeader $headerList)
    {
        $this->headerList = $headerList;
    }

    public function getHeaderList(): array
    {
        return array_merge(
            self::loggedInListOptions,
            $this->headerList->getHeaderList()
        );
    }
}