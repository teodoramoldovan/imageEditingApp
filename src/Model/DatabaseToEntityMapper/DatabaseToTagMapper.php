<?php


namespace ShareMyArt\Model\DatabaseToEntityMapper;


use ShareMyArt\Model\DomainObject\Tag;

class DatabaseToTagMapper
{
    /**
     * Will return a tag object with data from a database table row
     *
     * @param array $row representing a tag in the database
     * @return Tag
     */
    public static function getTagFromTableRow(array $row): Tag
    {
        return new Tag($row['tag_name'], $row['id']);
    }

}