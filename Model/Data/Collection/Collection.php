<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model\Data\Collection;

use JohnRogar\MageSpotlight\Model\DataItemInterface;
use \ArrayIterator;
use \IteratorIterator;

/**
 * Class Collection
 * @package JohnRogar\MageSpotlight\Model\Data\Collection
 */
final class Collection extends IteratorIterator implements CollectionInterface
{

    /**
     * DataCollection constructor.
     * @param DataItemInterface[] $data
     */
    public function __construct(array $data)
    {
        parent::__construct(new ArrayIterator($data));
    }

    /**
     * @inheritdoc
     */
    public function current(): DataItemInterface
    {
        return parent::current();
    }
}
