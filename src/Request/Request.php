<?php


namespace ShareMyArt\Request;


class Request
{
    public function getPostData(?string $key)
    {
        return (empty($key))
            ? $_POST
            : $_POST[$key];

    }

    public function getGetData(?string $key)
    {
        return $_GET[$key];
    }

    public function getSessionData(?string $key)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        return (empty($key))
            ? $_SESSION
            : $_SESSION[$key];
    }

    public function setSessionData(string $key, $data)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION[$key] = $data;
    }

    public function unsetSessionData(string $key)
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION[$key]);
    }

    public function getFiles(string $firstKey = null, string $secondKey = null)
    {

        return (null === $firstKey) ? $_FILES : $_FILES[$firstKey][$secondKey];
    }

}