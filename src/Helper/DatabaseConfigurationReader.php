<?php


namespace ShareMyArt\Helper;


class DatabaseConfigurationReader
{
    private const CONFIG_FILE_PATH = 'configurations/databaseConnectionConfig.php';

    /** @var array $configurationsArray */
    private static $configurationsArray;


    /**
     * Will return the database user from configuration file
     *
     * @return string
     */
    public static function getUser(): string
    {
        self::$configurationsArray = self::includeConfigurationFile();

        return self::$configurationsArray['user'];
    }

    private static function includeConfigurationFile(): array
    {
        if (!isset($configurationsArray)) {
            self::$configurationsArray = include self::CONFIG_FILE_PATH;;
        }
        return self::$configurationsArray;
    }

    /**
     * Will return the user password from configuration file
     *
     * @return string
     */
    public static function getPassword(): string
    {
        self::$configurationsArray = self::includeConfigurationFile();

        return self::$configurationsArray['password'];
    }

    /**
     *  Will return the dsn from configuration file
     *
     * @return string
     */
    public static function getDsn(): string
    {

        self::$configurationsArray = self::includeConfigurationFile();


        return self::$configurationsArray['dsn'];
    }

}