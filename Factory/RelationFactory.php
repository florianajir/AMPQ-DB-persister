<?php
namespace Meup\Bundle\SnotraBundle\Factory;

use InvalidArgumentException;
use Meup\Bundle\SnotraBundle\DataMapper\DataMapper;
use Meup\Bundle\SnotraBundle\Model\ManyToManyRelation;
use Meup\Bundle\SnotraBundle\Model\ManyToOneRelation;
use Meup\Bundle\SnotraBundle\Model\OneToManyRelation;
use Meup\Bundle\SnotraBundle\Model\OneToOneRelation;
use ReflectionClass;

/**
 * Class RelationFactory
 *
 * @author florianajir <florian@1001pharmacies.com>
 */
class RelationFactory implements RelationFactoryInterface
{
    const RELATION_FACTORY = 'Meup\Bundle\SnotraBundle\Model\RelationInterface';

    /**
     * @var ReflectionClass
     */
    protected $oneToOneClass;

    /**
     * @var ReflectionClass
     */
    protected $oneToManyClass;

    /**
     * @var ReflectionClass
     */
    protected $manyToOneClass;

    /**
     * @var ReflectionClass
     */
    protected $manyToManyClass;

    /**
     * @param string $oneToOneClassName
     * @param string $oneToManyClassName
     * @param string $manyToOneClassName
     * @param string $manyToManyClassName
     */
    public function __construct(
        $oneToOneClassName,
        $oneToManyClassName,
        $manyToOneClassName,
        $manyToManyClassName
    ) {
        $this->oneToOneClass = $this->createRelation($oneToOneClassName);
        $this->oneToManyClass = $this->createRelation($oneToManyClassName);
        $this->manyToOneClass = $this->createRelation($manyToOneClassName);
        $this->manyToManyClass = $this->createRelation($manyToManyClassName);
    }

    /**
     * @param string $relationClassName
     *
     * @return ReflectionClass
     */
    private function createRelation($relationClassName)
    {
        $relation = new ReflectionClass($relationClassName);
        if (!$relation->implementsInterface(self::RELATION_FACTORY)) {
            throw new InvalidArgumentException();
        }

        return $relation;
    }

    /**
     * @param string $relation
     * @param array  $data
     *
     * @return ManyToManyRelation|ManyToOneRelation|OneToManyRelation|OneToOneRelation
     *
     * @throws InvalidArgumentException
     */
    public function create($relation, $data)
    {
        switch ($relation) {
            case DataMapper::RELATION_ONE_TO_ONE:
                return $this->createOneToOne($data);

            case DataMapper::RELATION_ONE_TO_MANY:
                return $this->createOneToMany($data);

            case DataMapper::RELATION_MANY_TO_ONE:
                return $this->createManyToOne($data);

            case DataMapper::RELATION_MANY_TO_MANY:
                return $this->createManyToMany($data);

            default:
                throw new InvalidArgumentException("Invalid relation : $relation");
        }
    }

    /**
     * @param array $data
     *
     * @return OneToOneRelation
     */
    protected function createOneToOne($data)
    {
        return $this->oneToOneClass->newInstance($data);
    }

    /**
     * @param array $data
     *
     * @return OneToManyRelation
     */
    protected function createOneToMany($data)
    {
        return $this->oneToManyClass->newInstance($data);
    }

    /**
     * @param array $data
     *
     * @return ManyToOneRelation
     */
    protected function createManyToOne($data)
    {
        return $this->manyToOneClass->newInstance($data);
    }

    /**
     * @param array $data
     *
     * @return ManyToManyRelation
     */
    protected function createManyToMany($data)
    {
        return $this->manyToManyClass->newInstance($data);
    }
}