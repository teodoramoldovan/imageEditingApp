<?php


namespace ShareMyArt\SuperGlobalsWrapper;


class SessionSuperGlobalWrapper
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function getSessionSuperGlobalData(): array
    {

        return $_SESSION;
    }

    public function setSessionSuperGlobal(string $key, $data)
    {

        $_SESSION[$key] = $data;
    }

    public function unsetSessionValue(string $key)
    {

        unset($_SESSION[$key]);
    }

}