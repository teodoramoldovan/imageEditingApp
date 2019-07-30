<?php


namespace ShareMyArt\Model\Persistence\Finder;

use PDO;

abstract class AbstractFinder
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * AbstractFinder constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return PDO
     */
    protected function getPdo(): PDO
    {
        return $this->pdo;
    }

    // TODO extract here what else is common to all finders

}