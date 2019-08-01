<?php


namespace ShareMyArt\Model\Helper;


class HeaderOptionsConstants
{
    /**
     * options available when the user is browsing the website anonymously
     */
    private const ANONYMOUS_OPTIONS = ['/user/login' => 'Login'];

    /**
     * options available when the user is logged in
     */
    private const LOGGED_IN_OPTIONS = ['/user/myUploads' => 'My Uploads',
        '/user/myOrders' => 'My Orders',
        '/product/upload' => 'Upload a photo',
        '/user/logout' => 'Logout'];

    public static function getLoggedInOptions():array
    {
        return self::LOGGED_IN_OPTIONS;
    }

    public static function getAnonymousOptions():array
    {
        return self::ANONYMOUS_OPTIONS;
    }

}