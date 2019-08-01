<?php

namespace ShareMyArt\Model\Persistence;


use PDO;
use ShareMyArt\Model\Helper\DatabaseConfigurationReader;
use ShareMyArt\Model\Persistence\Finder\AbstractFinder;
use ShareMyArt\Model\Persistence\Mapper\AbstractMapper;
use PDOException;

class PersistenceFactory
{
    private const REMOVE_NAMESPACE_PATTERN = '/.*(?<className>\\\.*)/';
    /**
     * @var array $mappers
     */
    private static $mappers = [];
    /**
     * @var array $finders
     */
    private static $finders = [];
    /**
     * @var $pdo
     */
    private static $pdo;

    /**
     * Entity mapper factory
     *
     * @param string $entityClass
     *
     * @return AbstractMapper
     */
    public static function createMapper(string $entityClass): AbstractMapper
    {
        $mapperClass = self::getMapperClassName($entityClass);
        // we ensure we create a single mapper instance of this type per request
        if (!isset(self::$mappers[$mapperClass])) {
            self::$mappers[$mapperClass] = new $mapperClass(self::createPdo());
        }
        return self::$mappers[$mapperClass];
    }

    /**
     * Will transform by convention an entity class name to its mapper class
     *
     * @param string $entityClass
     * @return string
     */
    private static function getMapperClassName(string $entityClass): string
    {
        preg_match(self::REMOVE_NAMESPACE_PATTERN, $entityClass, $matches);
        return 'ShareMyArt\Model\Persistence\Mapper' . $matches['className'] . 'Mapper';
    }

    /**
     * Returns PDO instance to use in mappers and finders.
     *
     * @return PDO
     */
    private static function createPdo(): PDO
    {
        // we ensure we create a single connection per request
        if (self::$pdo === null) {
            try {
                self::$pdo = new PDO(
                    DatabaseConfigurationReader::getDsn(),
                    DatabaseConfigurationReader::getUser(),
                    DatabaseConfigurationReader::getPassword(),
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
            } catch (PDOException $ex) {
                //will stop execution if the database connection cannot be established
                die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
            }
        }
        return self::$pdo;
    }

    /**
     * Entity finder factory
     *
     * @param string $entityClass
     *
     * @return AbstractFinder
     */
    public static function createFinder(string $entityClass): AbstractFinder
    {
        $finderClass = self::getFinderClassName($entityClass);
        // we ensure we create a single finder instance of this type per request
        if (!isset(self::$finders[$finderClass])) {
            self::$finders[$finderClass] = new $finderClass(self::createPdo());
        }
        return self::$finders[$finderClass];
    }

    /**
     * Will transform by convention an entity class name to its finder class name
     *
     * @param string $entityClass
     * @return string
     */
    private static function getFinderClassName(string $entityClass): string
    {
        preg_match(self::REMOVE_NAMESPACE_PATTERN, $entityClass, $matches);
        return 'ShareMyArt\Model\Persistence\Finder' . $matches['className'] . 'Finder';
    }
}