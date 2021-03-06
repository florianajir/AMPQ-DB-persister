<?php
namespace Ajir\RabbitMqSqlBundle\Model;

/**
 * Interface EntityInterface
 *
 * @author Florian Ajir <florianajir@gmail.com>
 */
interface EntityInterface
{
    /**
     * @param array $data
     *
     * @return self
     */
    public function addDataSet(array $data);

    /**
     * @return string
     */
    public function getTable();

    /**
     * @return array
     */
    public function getIdentifier();

    /**
     * @return string
     */
    public function getData();

    /**
     * @return array
     */
    public function getManyToOneRelations();

    /**
     * @return array
     */
    public function getManyToManyRelations();

    /**
     * @return array
     */
    public function getOneToManyRelations();

    /**
     * @return array
     */
    public function getOneToOneRelations();

    /**
     * @param string $property
     *
     * @return string
     */
    public function getProperty($property);

    /**
     * @param array $identifier
     *
     * @return self
     */
    public function setIdentifier(array $identifier);
}
