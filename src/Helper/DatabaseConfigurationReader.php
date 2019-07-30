<?php


namespace ShareMyArt\Helper;


class DatabaseConfigurationReader
{
    private const CONFIG_FILE_PATH = 'configurations/databaseConnectionConfig.php';

    /** @var array $configurationsArray */
    private $configurationsArray;


    /**
     * Will return the database user from configuration file
     *
     * @return string
     */
    public static function getUser(): string
    {
        if (!isset($configurationsArray)) {
            $configurationsArray = self::includeConfigurationFile();
        }

        return $configurationsArray['user'];
    }

    /**
     * Will return the user password from configuration file
     *
     * @return string
     */
    public static function getPassword(): string
    {
        if (!isset($configurationsArray)) {
            $configurationsArray = self::includeConfigurationFile();
        }
        return $configurationsArray['password'];
    }

    /**
     *  Will return the dsn from configuration file
     *
     * @return string
     */
    public static function getDsn(): string
    {
        if (!isset($configurationsArray)) {
            $configurationsArray = self::includeConfigurationFile();
        }

        return $configurationsArray['dsn'];
    }

    private static function includeConfigurationFile(): array
    {
        return include self::CONFIG_FILE_PATH;
    }

}