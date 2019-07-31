<?php


namespace ShareMyArt\Model\DomainObject;


class Tag
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $tagName;

    public function __construct(string $tagName, $id = null)
    {
        $this->id = $id;
        $this->tagName = $tagName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTagName(): string
    {
        return $this->tagName;
    }

    /**
     * @param string $tagName
     */
    public function setTagName(string $tagName): void
    {
        $this->tagName = $tagName;
    }

}