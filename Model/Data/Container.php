<?php

declare(strict_types=1);

namespace JohnRogar\MageSpotlight\Model\Data;

use JohnRogar\MageSpotlight\Model\Data\Collection\Collection;
use JohnRogar\MageSpotlight\Model\Data\Collection\CollectionInterface;
use JohnRogar\MageSpotlight\Model\DataItemInterface;

/**
 * Class DataProvider
 * @package JohnRogar\MageSpotlight\Model
 */
final class Container
{

    /**
     * @var DataItemInterface[]
     */
    private $items;

    /**
     * @param DataItemInterface $item
     * @return $this
     */
    public function push(DataItemInterface $item): Container
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return Container
     */
    public function clear(): Container
    {
        $this->items = [];
        return $this;
    }

    /**
     * @return CollectionInterface
     */
    public function getCollection(): CollectionInterface
    {
        return new Collection($this->items);
    }
}
