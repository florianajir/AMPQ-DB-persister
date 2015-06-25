<?php
namespace Meup\Bundle\SnotraBundle\Provider;

/**
 * Interface SqlProviderInterface
 *
 * @author florianajir <florian@1001pharmacies.com>
 */
interface SqlProviderInterface
{
    /**
     * Insert or update a record if exists
     *
     * @param string $table      The expression of the table to update quoted or unquoted.
     * @param array  $data       An associative array containing column-value pairs.
     * @param array  $identifier The update criteria. An associative array containing column-value pairs.
     */
    public function insertOrUpdateIfExists($table, array $data, array $identifier);

    /**
     * Return true if the record exists
     *
     * @param string $table      The expression of the table to update quoted or unquoted.
     * @param string $identifier The update criteria. An associative array containing column-value pairs.
     * @param string $value
     *
     * @return bool
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function exists($table, $identifier, $value);

    /**
     * Insert a record in sql database
     *
     * @param string $table The expression of the table to update quoted or unquoted.
     * @param array  $data  An associative array containing column-value pairs.
     */
    public function insert($table, array $data);

    /**
     * Update a record in sql database
     *
     * @param string $table      The expression of the table to update quoted or unquoted.
     * @param array  $data       An associative array containing column-value pairs.
     * @param array  $identifier The update criteria. An associative array containing column-value pairs.
     */
    public function update($table, array $data, array $identifier);
}
