<?php

namespace Meup\Bundle\SnotraBundle\ElasticSearch;

use Elastica\Index;
use Meup\DataStructure\Message\AMPQMessageInterface;

/**
 *
 */
interface IndexerInterface
{
    /**
     * @param Index $index
     * @param AMPQMessageInterface $message
     * 
     * @return boolean
     */
    public function execute(Index $index, AMPQMessageInterface $message);
}